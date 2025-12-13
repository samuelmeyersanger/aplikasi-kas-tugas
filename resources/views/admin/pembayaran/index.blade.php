<x-auth-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Verifikasi Pembayaran</h2>
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tagihan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($pembayarans as $pembayaran)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $pembayaran->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $pembayaran->tagihan->judul }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Rp. {{ number_format($pembayaran->jumlah_dibayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($pembayaran->status == 'terverifikasi') bg-green-100 text-green-800
                                        @elseif($pembayaran->status == 'ditolak') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($pembayaran->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.pembayaran.show', $pembayaran->id) }}" class="text-indigo-600 hover:text-indigo-900">Detail & Verifikasi</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada pembayaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pembayarans->links() }}
        </x-card>
    </div>
</x-auth-layout>