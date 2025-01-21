<x-app-layout>
    <x-layout>
        @if (session()->has('success'))
        <div id="alert-2"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-2" aria-label="Close">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
        @endif
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="/admin/detailTransaksi" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Detail Transaksi</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="flex justify-between items-center mb-4">
            <h1 class="py-2 text-xl font-bold text-gray-900 dark:text-white">Daftar Detail Transaksi</h1>
        </div>
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 p-4">

                {{-- search --}}
                <div class="flex items-center w-full">
                    <form action="" method="GET" class="flex items-center w-full max-w-md space-x-2">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari Produk..." value="{{ request()->query('search') }}" class="block w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Cari
                        </button>
                    </form>
                </div>

            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">ID TRX</th>
                            <th scope="col" class="px-4 py-3">Nama Customer</th>
                            <th scope="col" class="px-4 py-3">Nama Staff</th>
                            <th scope="col" class="px-4 py-3">Produk</th>
                            <th scope="col" class="px-4 py-3">Metode Pembayaran</th>
                            <th scope="col" class="px-4 py-3">Harga satuan</th>
                            <th scope="col" class="px-4 py-3">jumlah</th>
                            <th scope="col" class="px-4 py-3">Sub Total</th>
                            <th scope="col" class="px-4 py-3">Tanggal Transaksi</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($details as $detail)
                        <tr class="border-b dark:border-gray-700">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>

                            <td class="px-4 py-3">{{ $detail->id_transaksi }}</td>
                            <td class="px-4 py-3">{{ $detail->transaksi->pelanggan->nama }}</td>
                            <td class="px-4 py-3">{{ $detail->transaksi->user->name }}</td>
                            <td class="px-4 py-3">{{ $detail->produk->nama }}</td>
                            <td class="px-4 py-3">{{ $detail->transaksi->metodeBayar->nama }}</td>
                            <td class="px-4 py-3">{{ $detail->harga_satuan }}</td>
                            <td class="px-4 py-3">{{ $detail->jumlah }}</td>
                            <td class="px-4 py-3">{{ $detail->total_harga }}</td>
                            <td class="px-4 py-3">{{ $detail->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </x-layout>
</x-app-layout>
