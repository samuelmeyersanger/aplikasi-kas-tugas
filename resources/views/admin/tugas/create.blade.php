<x-auth-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Buat Tugas Baru</h2>

            <form method="POST" action="{{ route('admin.tugas.store') }}">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <x-input label="Judul Tugas" name="judul" type="text" value="{{ old('judul') }}" required autofocus />
                    
                    <div>
                        <x-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <x-input label="Batas Waktu" name="batas_waktu" type="date" value="{{ old('batas_waktu') }}" required />
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.tugas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <x-button type="submit">Simpan Tugas</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-auth-layout>