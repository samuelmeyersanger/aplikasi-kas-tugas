<x-auth-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Dashboard Admin</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ $totalMahasiswa }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Total Mahasiswa</div>
                </x-card>
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $pembayaranMenunggu }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Pembayaran Menunggu</div>
                </x-card>
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-green-600">Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Total Pemasukan Kas</div>
                </x-card>
                <x-card class="text-center">
                    <div class="text-2xl font-bold text-red-600">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    <div class="text-gray-600 dark:text-gray-400">Total Pengeluaran Kas</div>
                </x-card>
            </div>
        </div>
    </div>
</x-auth-layout>