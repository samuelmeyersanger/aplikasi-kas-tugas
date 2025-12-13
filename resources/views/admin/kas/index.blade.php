<x-auth-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-card>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Manajemen Kas</h2>
                <a href="{{ route('admin.kas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Tambah Transaksi
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Keterangan
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jenis
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Aksi</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($transaksiKas as $kas)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ \Carbon\Carbon::parse($kas->tanggal_transaksi)->isoFormat('DD MMMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    {{ $kas->keterangan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold leading-tight rounded-full
                                        @if($kas->jenis === 'pemasukan') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                        {{ ucfirst($kas->jenis) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium
                                    @if($kas->jenis === 'pemasukan') text-green-600 dark:text-green-400
                                    @else text-red-600 dark:text-red-400 @endif">
                                    Rp. {{ number_format($kas->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.kas.edit', $kas->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                                    <form action="{{ route('admin.kas.destroy', $kas->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    Belum ada data transaksi kas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $transaksiKas->links() }}
            </div>
        </x-card>
    </div>
</x-auth-layout>