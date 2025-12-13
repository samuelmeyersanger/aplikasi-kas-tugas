<x-auth-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Dashboard Mahasiswa</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $tugasBelumSelesai }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Tugas Belum Selesai</div>
                </x-card>
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $pembayaranMenunggu }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Pembayaran Ditinjau</div>
                </x-card>
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $tagihanBelumBayar }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Tagihan Belum Dibayar</div>
                </x-card>
            </div>
        </div>
    </div>
</x-auth-layout>