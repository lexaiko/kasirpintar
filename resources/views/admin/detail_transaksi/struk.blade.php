<x-app-layout>
    <div class="container-fluid mx-[200px]">
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
        <div class="flex justify-between items-center mb-4">
            <h1 class="py-2 text-xl font-bold text-gray-900 dark:text-white">Daftar Detail Transaksi</h1>
        </div>
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 p-4">

                {{-- search --}}
                <div class="flex items-center w-full">
                    <div class="flex gap-4">
                    <div class="flex items-center justify-start w-full">
                        <a href="{{ route('Cart') }}"
                            class="whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Kembali ke Cart
                        </a>
                    </div>
                    <div class="flex items-center justify-start w-full">
                        <a href="{{ route('transaksi.struk', $details[0]->id_transaksi) }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Cetak Struk
                        </a>
                    </div>
                </div>
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
                            <th scope="col" class="px-4 py-3">Satuan</th>
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
                                <td class="px-4 py-3 whitespace-nowrap">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $detail->jumlah }}</td>
                                <td class="px-4 py-3">{{ $detail->produk->satuan->nama }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $detail->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
            <div class="justify-self-end mr-8 py-3">
                <div>
                    <p>
                        <span class="font-bold text-lg">
                            Nama Customer:
                        </span>
                        <span class="text-lg font-semibold">
                            {{ $details->first()->transaksi->pelanggan->nama }}
                        </span>
                    </p>
                </div>
                <div>
                    <span class="font-bold text-lg">
                        Metode Pembayaran:
                    </span>
                    <span class="text-lg font-semibold">
                        {{ $details->first()->transaksi->metodeBayar->nama }}
                    </span>
                </div>
                <div>
                    <span class="font-bold text-lg">
                        Total Belanja:
                    </span>
                    <span class="text-lg font-semibold">
                        Rp {{ number_format($details->first()->transaksi->total_belanja, 0, ',', '.') }}
                    </span>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
