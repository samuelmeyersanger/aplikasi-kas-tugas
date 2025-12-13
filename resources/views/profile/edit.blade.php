<x-auth-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Profil Saya</h2>

                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <!-- Nama -->
                    <div>
                        <x-label for="name" value="Nama Lengkap" />
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="Email" />
                        <x-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    </div>

                    <!-- Field Khusus Mahasiswa -->
                    @if($user->hasRole('Mahasiswa'))
                        <!-- NIM -->
                        <div>
                            <x-label for="nim" value="NIM" />
                            <x-input id="nim" name="nim" type="text" class="mt-1 block w-full" value="{{ old('nim', $user->nim) }}" required autocomplete="nim" />
                        </div>

                        <!-- Jurusan -->
                        <div>
                            <x-label for="jurusan" value="Jurusan" />
                            <x-input id="jurusan" name="jurusan" type="text" class="mt-1 block w-full" value="{{ old('jurusan', $user->jurusan) }}" required autocomplete="jurusan" />
                        </div>
                    @endif

                    <div class="flex items-center gap-4">
                        <x-button type="submit">Simpan Perubahan</x-button>

                        @if ($user->hasVerifiedEmail())
                            <button type="button" class="text-sm text-gray-600 dark:text-gray-400 underline" onclick="document.getElementById('update-password-form').classList.toggle('hidden')">
                                Ubah Password
                            </button>
                        @endif
                    </div>
                </form>

                <!-- Form Ubah Password (Awalnya Tersembunyi) -->
                <div id="update-password-form" class="hidden mt-8 pt-8 border-t border-gray-300 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Ubah Password</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Pastikan password Anda panjang dan acak untuk tetap aman.</p>

                    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        <!-- Password Saat Ini -->
                        <div>
                            <x-label for="current_password" value="Password Saat Ini" />
                            <x-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        </div>

                        <!-- Password Baru -->
                        <div>
                            <x-label for="password" value="Password Baru" />
                            <x-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div>
                            <x-label for="password_confirmation" value="Konfirmasi Password Baru" />
                            <x-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-button type="submit">Simpan Password</x-button>
                        </div>
                    </form>
                </div>

                <!-- Form Hapus Akun -->
                <div class="mt-8 pt-8 border-t border-gray-300 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-red-600 dark:text-red-400">Hapus Akun</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>

                    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="password" value="{{ old('password') }}" required>

                        <x-input name="password" type="password" class="mt-1 block w-full" placeholder="Masukkan password untuk konfirmasi" required autocomplete="current-password" />
                        
                        <x-button type="submit" class="mt-4 bg-red-600 hover:bg-red-700 focus:bg-red-700">
                            Hapus Akun
                        </x-button>
                    </form>
                </div>
            </x-card>
        </div>
    </div>
</x-auth-layout>