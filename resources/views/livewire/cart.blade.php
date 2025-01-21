<div class="container-fluid px-[100px] mt-3">
    <!-- Pesan Sukses -->
    @if (session()->has('pesan'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('pesan') }}
        </div>
    @endif

    <!-- Pesan Error -->
    @if (session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
     <!-- Pesan Error -->
     @if (session()->has('error_opsi'))
     <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
         {{ session('error') }}
     </div>
 @endif
    <!-- Pesan Error -->
    @if (session()->has('error_stok'))
        <div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error_stok') }}
        </div>
    @endif
<!-- Pesan Error -->
@if (session()->has('error_keranjang'))
<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
    {{ session('error_stok') }}
</div>
@endif
    <div class="grid grid-cols-2 md:flex-row gap-6 w-full">
        <!-- Kiri: Daftar Produk -->
        <div class="h-[600px] col-span-1 bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold mb-4">Daftar Produk</h2>
            <!-- Input Pencarian -->
            <div class="mb-4">
                <input type="text" wire:model.live="search" placeholder="Cari produk..."
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" />
            </div>

            <!-- Daftar Produk dengan Scroll Vertikal -->
            <div class="h-[450px] overflow-y-auto">
                <ul class="space-y-2">
                    @forelse($daftarProduk as $produk)
                        <li wire:key="produk-{{ $produk->id_produk }}"
                            class="flex justify-between items-center border-b pb-2">
                            <div wire:key="produk-{{ $produk->id_produk }}" class="product-card flex gap-3">
                                <div>
                                    @if ($produk->gambar && Storage::disk('public')->exists($produk->gambar))
                                        <img class="w-16 object-cover" src="{{ asset('storage/' . $produk->gambar) }}"
                                            alt="{{ $produk->nama }}">
                                    @else
                                        No pict
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-medium">{{ $produk['nama'] }}</p>
                                    <p class="text-xs text-gray-500">Rp
                                        {{ number_format($produk['harga'], 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500">Stok: {{ $produk['stok']['jumlah'] ?? 0 }}</p>
                                </div>
                            </div>
                            <button wire:click="tambahkanKeKeranjang({{ $produk['id_produk'] }})"
                                class="px-3 py-1 bg-yellow-400 text-white text-sm rounded">
                                Tambah
                            </button>
                        </li>
                    @empty
                        <li>
                            <p class="text-gray-500">Produk tidak ditemukan.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Kanan: Keranjang -->
        <div class="h-full col-span-1 bg-white shadow rounded">
            <div class=" p-4 bg-white">
                <h2 class="text-lg font-bold mb-4">Keranjang</h2>
                <div class="h-3/4 overflow-y-auto">
                    @if ($keranjang)
                        <ul class="space-y-2">
                            @foreach ($keranjang as $item)
                                <li wire:key="produk-{{ $produk->id_produk }}"
                                    class="flex flex-col gap-2 border-b pb-2">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-medium">{{ $item['nama'] }}</p>
                                            <p class="text-xs text-gray-500">Rp
                                                {{ number_format($item['harga'], 0, ',', '.') }}
                                            </p>
                                            <p class="text-xs text-gray-500">Stok tersedia:
                                                {{ $item['stok_tersedia'] }}
                                            </p>
                                        </div>
                                        <button wire:click="hapusProduk({{ $item['id_produk'] }})"
                                            class="text-red-500 text-sm hover:underline">
                                            Hapus
                                        </button>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div wire:key="produk-{{ $produk->id_produk }}"
                                            class="flex items-center gap-2">
                                            <button wire:click="kurangiJumlah({{ $item['id_produk'] }})"
                                                class="px-2 bg-gray-300 rounded">-</button>
                                            <span>{{ $item['jumlah'] }}</span>
                                            <button wire:click="tambahJumlah({{ $item['id_produk'] }})"
                                                class="px-2 bg-gray-300 rounded">+</button>
                                        </div>
                                        <p class="text-sm font-bold">
                                            Subtotal: Rp
                                            {{ number_format($item['jumlah'] * $item['harga'], 0, ',', '.') }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Keranjang kosong.</p>
                    @endif
                </div>
                <!-- Pilihan Customer dan Metode Pembayaran -->
                <div class="mt-4 grid grid-cols-2 gap-4 bg-white">

                    <!-- Pilih Customer -->
                    <div class="mb-4 col-span-1">
                        <label for="id_pelanggan" class="block text-sm font-medium">Pilih Pelanggan</label>
                        <select wire:model="id_pelanggan" id="id_Pelanggan"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggan as $customer)
                                <option value="{{ $customer->id_pelanggan }}">{{ $customer->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Metode Pembayaran -->
                    <div class="mb-4 col-span-1">
                        <div>
                            <label for="id_metode" class="block text-sm font-medium">Pilih Metode
                                Pembayaran</label>
                            <select wire:model="id_metode" id="id_metode"
                                class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                                <option value="">Pilih Metode Pembayaran</option>
                                @foreach ($metodeBayar as $metode)
                                    <option value="{{ $metode->id_metode }}">{{ $metode->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tombol Simpan -->
                        <div class="bg-white p-4">
                            <div class="mb-2">
                                <p class="text-right text-lg font-bold">
                                    Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                </p>
                            </div>
                            <div>
                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                    class="w-full block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                    Simpan Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin
                        menyelesaikan pembayaran?</h3>
                    <button data-modal-hide="popup-modal" wire:click="simpan" type="button"
                        class="text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Ya, saya yakin
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak,
                        batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
