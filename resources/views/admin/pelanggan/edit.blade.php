<x-app-layout>
        <x-layout>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/admin/pelanggan" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">

                            pelanggan
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="/admin/pelanggan" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit pelanggan</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-bold mb-4">Edit pelanggan</h1>

                @if (session('success'))
                <div class="bg-green-500 text-white p-4 mb-4">
                    {{ session('success') }}
                </div>
                @endif

            <form action="{{ route('admin.pelanggan.update', $pelanggan->id_pelanggan) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-2 sm:grid-cols-2 sm:gap-2">
                    <div class="sm:col-span-1">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama pelanggan</label>
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('nama') is-invalid @enderror" value="{{ old('nama', $pelanggan->nama) }}" required>
                        @error('nama')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Hp</label>
                        <input type="text" name="no_hp" id="no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $pelanggan->no_hp) }}" required>
                        @error('no_hp')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('alamat') is-invalid @enderror" value="{{ old('alamat', $pelanggan->alamat) }}" required>
                        @error('alamat')
                        <div class="invalid-feedback text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">Ubah pelanggan</button>
            </form>
        </x-layout>
</x-app-layout>
