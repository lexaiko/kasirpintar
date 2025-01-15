<x-app-layout>
        <x-layout>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/admin/produk" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

                            Produk
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="/admin/Produk" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit Produk</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold mb-4">Edit Produk</h1>

                @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4">
                    {{ session('success') }}
                </div>
                @endif

            <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-2 sm:grid-cols-2 sm:gap-2">
                    <div class="sm:col-span-1">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('nama') is-invalid @enderror" value="{{ old('nama', $produk->nama) }}" required>
                        @error('nama')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="id_kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select id="id_kategori" name="id_kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_kategori') is-invalid @enderror">
                            @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $produk->id_kategori) == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="id_merek" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Merek</label>
                        <select id="id_merek" name="id_merek" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_merek') is-invalid @enderror">
                            @foreach($merek as $k)
                            <option value="{{ $k->id_merek }}" {{ old('id_merek', $produk->id_merek) == $k->id_merek ? 'selected' : '' }}>{{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('id_merek')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-full">
                        <div>
                            <label for="id_satuan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Satuan</label>
                            <select id="id_satuan" name="id_satuan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_satuan') is-invalid @enderror">
                                @foreach($satuan as $k)
                                <option value="{{ $k->id_satuan }}" {{ old('id_satuan', $produk->id_satuan) == $k->id_satuan ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_satuan')
                            <div class="invalid-feedback text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Produk</label>
                        <div class="grid grid-cols-2 gap-2">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" class="object-cover w-full h-48 rounded-lg" alt="{{ $produk->nama }}">
                            <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('gambar') is-invalid @enderror">
                        </div>
                        @error('gambar')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok</label>
                        <input type="text" name="stok" id="stok" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('stok') is-invalid @enderror" value="{{ old('stok', $produk->stok) }}" required>
                        @error('stok')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
                        <input type="text" name="harga" id="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('harga') is-invalid @enderror" value="{{ old('harga', $produk->harga) }}" required>
                        @error('harga')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">Ubah Produk</button>
            </form>
        </x-layout>
</x-app-layout>
