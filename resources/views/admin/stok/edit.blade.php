<x-app-layout>
    <x-layout>
        <!-- Breadcrumb -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/admin/stok" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        stok
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="/admin/stok" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit stok</a>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-4">Edit stok</h1>

        <!-- Success Message -->
        @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.stok.update', $stok->id_stok) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 sm:grid-cols-2">
                <!-- Input Field -->
                <div class="sm:col-span-1">
                    <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">jumlah stok</label>
                    <input
                        type="text"
                        name="jumlah"
                        id="jumlah"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('jumlah') is-invalid @enderror"
                        value="{{ old('jumlah', $stok->jumlah) }}"
                        required>
                    @error('jumlah')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-6 text-sm font-medium text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                Ubah stok
            </button>
        </form>
    </x-layout>
</x-app-layout>
