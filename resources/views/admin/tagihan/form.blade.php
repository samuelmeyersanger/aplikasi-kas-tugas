<x-auth-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                @isset($tagihan) -> Edit Tagihan @else -> Buat Tagihan Baru @endisset
            </h2>
            <form method="POST" action="{{ isset($tagihan) ? route('admin.tagihan.update', $tagihan->id) : route('admin.tagihan.store') }}">
                @csrf @isset($tagihan) @method('PUT') @endisset
                <div class="grid grid-cols-1 gap-6">
                    <x-input label="Judul Tagihan" name="judul" type="text" value="{{ old('judul', $tagihan->judul ?? '') }}" required autofocus />
                    <x-textarea label="Deskripsi" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $tagihan->deskripsi ?? '') }}"></x-textarea>
                    <x-input label="Jumlah (Rp)" name="jumlah" type="number" step="0.01" value="{{ old('jumlah', $tagihan->jumlah ?? '') }}" required />
                    <x-input label="Tanggal Tagihan" name="tanggal_tagihan" type="date" value="{{ old('tanggal_tagihan', $tagihan->tanggal_tagihan ?? '') }}" required />
                    <x-input label="Batas Pembayaran" name="batas_pembayaran" type="date" value="{{ old('batas_pembayaran', $tagihan->batas_pembayaran ?? '') }}" required />
                </div>
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.tagihan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</a>
                    <x-button type="submit">Simpan</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-auth-layout>