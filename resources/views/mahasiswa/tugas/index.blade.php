<x-auth-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Tugas</h2>
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            <div class="space-y-4">
                @forelse ($tugas as $t)
                    <div class="p-4 border rounded-lg dark:border-gray-700 @if($t->users->isNotEmpty()) bg-green-50 dark:bg-green-900/20 @else bg-white dark:bg-gray-800 @endif">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $t->judul }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $t->deskripsi }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">Batas Waktu: {{ \Carbon\Carbon::parse($t->batas_waktu)->isoFormat('DD MMMM YYYY') }}</p>
                                
                                {{-- Tampilkan link download jika file sudah ada --}}
                                @if($t->users->isNotEmpty() && $t->users->first()->pivot->file_path)
                                    <a href="{{ asset('storage/' . $t->users->first()->pivot->file_path) }}" target="_blank" class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
                                        Download File
                                    </a>
                                @endif
                            </div>
                            <div>
                                @if($t->users->isEmpty())
    <form action="{{ route('mahasiswa.tugas.complete', $t->id) }}" method="POST" class="text-right" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unggah File (Opsional)</label>
            <input type="file" name="file" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Atau Tempelkan Link (Opsional)</label>
            <input type="url" name="submission_link" placeholder="https://..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm">
        </div>
        <x-button type="submit">Tandai Selesai</x-button>
    </form>
@else
    {{-- Tampilkan link jika ada --}}
    @if($t->users->first()->pivot->submission_link)
        <a href="{{ $t->users->first()->pivot->submission_link }}" target="_blank" class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 hover:bg-purple-200">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
            Buka Link
        </a>
    @endif

    {{-- Tampilkan download file jika ada --}}
    @if($t->users->first()->pivot->file_path)
        <a href="{{ asset('storage/' . $t->users->first()->pivot->file_path) }}" target="_blank" class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path></svg>
            Download File
        </a>
    @endif
@endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada tugas saat ini.</p>
                @endforelse
            </div>
        </x-card>
    </div>
</x-auth-layout>