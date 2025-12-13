<x-auth-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                @isset($mahasiswa) -> Edit Mahasiswa @else -> Tambah Mahasiswa @endisset
            </h2>

            <form method="POST" action="{{ isset($mahasiswa) ? route('admin.mahasiswa.update', $mahasiswa->id) : route('admin.mahasiswa.store') }}">
                @csrf
                @isset($mahasiswa)
                    @method('PUT')
                @endisset

                <div class="grid grid-cols-1 gap-6">
                    <x-input label="Nama" name="name" type="text" value="{{ old('name', $mahasiswa->name ?? '') }}" required autofocus />
                    <x-input label="NIM" name="nim" type="text" value="{{ old('nim', $mahasiswa->nim ?? '') }}" required />
                    <x-input label="Email" name="email" type="email" value="{{ old('email', $mahasiswa->email ?? '') }}" required />
                    <x-input label="Jurusan" name="jurusan" type="text" value="{{ old('jurusan', $mahasiswa->jurusan ?? '') }}" required />
                    
                    <x-input label="Password (kosongkan jika tidak ingin mengubah)" name="password" type="password" />
                    <x-input label="Konfirmasi Password" name="password_confirmation" type="password" />
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">
                        Batal
                    </a>
                    <x-button type="submit">
                        Simpan
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-auth-layout>