<x-auth-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Daftar Tagihan & Pembayaran</h2>
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">{{ session('error') }}</div>
            @endif

            <div class="space-y-6">
                @forelse ($tagihans as $tagihan)
                    <div class="p-4 border rounded-lg dark:border-gray-700 bg-white dark:bg-gray-800">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $tagihan->judul }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $tagihan->deskripsi }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-2">
                                    Jumlah: <span class="font-bold">Rp. {{ number_format($tagihan->jumlah, 0, ',', '.') }}</span> | 
                                    Batas Bayar: {{ \Carbon\Carbon::parse($tagihan->batas_pembayaran)->isoFormat('DD MMMM YYYY') }}
                                </p>
                            </div>
                            <div class="ml-4">
                                @php
                                    $lastPayment = $tagihan->pembayarans->last();
                                @endphp
                                @if($lastPayment && $lastPayment->status === 'terverifikasi')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Terverifikasi</span>
                                @elseif($lastPayment && $lastPayment->status === 'menunggu')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                                @else
                                    <button onclick="document.getElementById('payment-form-{{ $tagihan->id }}').classList.toggle('hidden')" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                        Bayar Sekarang
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Form Pembayaran -->
                        @if(!$lastPayment || $lastPayment->status === 'ditolak')
                            <form id="payment-form-{{ $tagihan->id }}" action="{{ route('mahasiswa.pembayaran.store', $tagihan->id) }}" method="POST" class="hidden mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-label for="metode_pembayaran" value="Metode Pembayaran" />
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-900 dark:border-gray-600">
                                            <option value="dana">DANA</option>
                                            <option value="gopay">GoPay</option>
                                            <option value="transfer">Transfer Bank</option>
                                        </select>
                                    </div>
                                    <div>
                                        <x-label for="bukti_pembayaran" value="Upload Bukti Pembayaran" />
                                        <input name="bukti_pembayaran" type="file" id="bukti_pembayaran" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="button" onclick="document.getElementById('payment-form-{{ $tagihan->id }}').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg mr-2">Batal</button>
                                    <x-button type="submit">Unggah Bukti</x-button>
                                </div>
                            </form>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada tagihan saat ini.</p>
                @endforelse
            </div>
        </x-card>
    </div>
</x-auth-layout>