<x-app-layout>
    <x-layout>
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/admin/produk" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Detail Transaksi
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="/admin/produk" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit Detail Transaksi</a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-4">Edit Detail Transaksi</h1>

        <!-- Success Message -->
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.detailTransaksi.update', $detail->id_detail) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:grid-cols-2">
                <!-- Input Field for Id Transaksi -->
                <div>
                    <label for="id_transaksi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Transaksi</label>
                    <select id="id_transaksi" name="id_transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_kategori') is-invalid @enderror">
                        @foreach($transaksi as $t)
                        <option value="{{ $t->id_transaksi }}" {{ old('id_transaksi', $detail->id_transaksi) == $t->id_transaksi ? 'selected' : '' }}>{{ $t->id_transaksi }}</option>
                        @endforeach
                    </select>
                    @error('id_transaksi')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Input Field for Produk Name -->
                <div>
                    <label for="id_produk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Produk</label>
                    <select id="id_produk" name="id_produk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_kategori') is-invalid @enderror">
                        @foreach($produk as $p)
                        <option value="{{ $p->id_produk }}" {{ old('id_produk', $detail->id_produk) == $p->id_produk ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_produk')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Input Field for Harga Satuan -->
                <div class="sm:col-span-2">
                    <label for="harga_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga Satuan</label>
                    <input type="number" name="harga_satuan" id="harga_satuan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('harga_satuan') is-invalid @enderror"
                        value="{{ old('harga_satuan', $detail->harga_satuan) }}" required>
                    @error('harga_satuan')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Input Field for Jumlah -->
                <div class="sm:col-span-2">
                    <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('jumlah') is-invalid @enderror"
                        value="{{ old('jumlah', $detail->jumlah) }}" required>
                    @error('jumlah')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Input Field for Total Harga -->
                <div class="sm:col-span-2">
                    <label for="total_harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Harga</label>
                    <input type="number" step="0.01" name="total_harga" id="total_harga"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('total_harga') is-invalid @enderror"
                        value="{{ old('total_harga', $detail->total_harga) }}" required>
                    @error('total_harga')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                Ubah Detail Transaksi
            </button>
        </form>
    </x-layout>
</x-app-layout>