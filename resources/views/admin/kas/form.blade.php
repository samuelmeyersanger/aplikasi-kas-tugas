<x-auth-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                @isset($kas) -> Edit Transaksi Kas @else -> Tambah Transaksi Kas Baru @endisset
            </h2>

            <form method="POST" action="{{ isset($kas) ? route('admin.kas.update', $kas->id) : route('admin.kas.store') }}">
                @csrf
                @isset($kas)
                    @method('PUT')
                @endisset

                <div class="grid grid-cols-1 gap-6">
                    <!-- Jenis Transaksi -->
                    <div>
                        <x-label for="jenis" value="Jenis Transaksi" />
                        <select id="jenis" name="jenis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600" required>
                            <option value="">Pilih Jenis</option>
                            <option value="pemasukan" @if(old('jenis', $kas->jenis ?? '') === 'pemasukan') selected @endif>Pemasukan</option>
                            <option value="pengeluaran" @if(old('jenis', $kas->jenis ?? '') === 'pengeluaran') selected @endif>Pengeluaran</option>
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <x-input label="Jumlah (Rp)" name="jumlah" type="number" step="0.01" value="{{ old('jumlah', $kas->jumlah ?? '') }}" required />

                    <!-- Keterangan -->
                    <x-textarea label="Keterangan" name="keterangan" id="keterangan" value="{{ old('keterangan', $kas->keterangan ?? '') }}" required></x-textarea>

                    <!-- Tanggal Transaksi -->
                    <x-input label="Tanggal Transaksi" name="tanggal_transaksi" type="date" value="{{ old('tanggal_transaksi', $kas->tanggal_transaksi ?? \Carbon\Carbon::now()->format('Y-m-d')) }}" required />
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.kas.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2 transition ease-in-out duration-150">
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