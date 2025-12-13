<x-auth-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Detail Pembayaran</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Informasi Mahasiswa</h3>
                    <p><strong>Nama:</strong> {{ $pembayaran->user->name }}</p>
                    <p><strong>NIM:</strong> {{ $pembayaran->user->nim }}</p>
                    <p><strong>Jurusan:</strong> {{ $pembayaran->user->jurusan }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Informasi Tagihan</h3>
                    <p><strong>Judul:</strong> {{ $pembayaran->tagihan->judul }}</p>
                    <p><strong>Jumlah Dibayar:</strong> Rp. {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</p>
                    <p><strong>Metode:</strong> {{ ucfirst($pembayaran->metode_pembayaran) }}</p>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Bukti Pembayaran</h3>
                <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="rounded-lg shadow-md max-w-md">
            </div>

            <hr class="my-6 border-gray-300 dark:border-gray-600">

            <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <x-label for="status" value="Verifikasi Pembayaran" />
                    <div class="mt-2 space-x-6">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="terverifikasi" class="form-radio" @if($pembayaran->status === 'terverifikasi') checked @endif>
                            <span class="ml-2">Terverifikasi</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="ditolak" class="form-radio" @if($pembayaran->status === 'ditolak') checked @endif>
                            <span class="ml-2">Ditolak</span>
                        </label>
                    </div>
                </div>
                <x-textarea label="Catatan Verifikasi (Opsional)" name="catatan_verifikasi" id="catatan_verifikasi" value="{{ old('catatan_verifikasi', $pembayaran->catatan_verifikasi) }}"></x-textarea>
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.pembayaran.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Kembali</a>
                    <x-button type="submit">Update Status</x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-auth-layout>