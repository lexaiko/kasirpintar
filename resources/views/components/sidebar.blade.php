<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">

        <ul class="space-y-2">
            <li>
                <a href="/dashboard"
                    class="flex items-center p-2 text-base font-medium {{ request()->is('dashboard') || request()->is('dashboard') || request()->is('dashboard') || request()->has('query') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 {{ request()->is('dashboard') || request()->is('dashboard') || request()->is('dashboard') || request()->has('query') ? 'text-white' : 'text-gray-800' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <button type="button"
                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/produk*') || request()->is('admin/kategori*') || request()->is('admin/merek*') || request()->is('admin/satuan*') ? 'bg-amber-500 text-white' : '' }}"
                aria-controls="dropdown-example"
                aria-expanded="{{ request()->is('admin/produk*') || request()->is('admin/kategori*') ? 'true' : 'false' }}"
                data-collapse-toggle="dropdown-example">
                <!-- Icon SVG Produk -->
                <svg class="w-[31px] h-[31px] {{ request()->is('admin/produk*') || request()->is('admin/kategori*') || request()->is('admin/merek*') || request()->is('admin/satuan*') ? 'text-white' : 'text-gray-800' }} dark:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z"
                        clip-rule="evenodd" />
                </svg>

                <!-- Teks Produk -->
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Produk</span>

                <!-- Icon Dropdown -->
                <svg class="w-3 h-3 {{ request()->is('admin/produk*') || request()->is('admin/kategori*') || request()->is('admin/merek*') || request()->is('admin/satuan*') ? 'text-white' : 'text-gray-800' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="dropdown-example"
                class="{{ request()->is('admin/produk*') || request()->is('admin/kategori*') || request()->is('admin/satuan*') || request()->is('admin/merek*') ? '' : 'hidden' }} py-2 space-y-2">
                <li>
                    <a href="{{ url('admin/kategori') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/kategori') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/merek') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/merek') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Merek
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/satuan') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/satuan') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Satuan
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/produk') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/produk') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Produk
                    </a>
                </li>
            </ul>
            <button type="button"
                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/pelanggan*') || request()->is('admin/user*') ? 'bg-amber-500 text-white' : '' }}"
                aria-controls="dropdown-user"
                aria-expanded="{{ request()->is('admin/pelanggan*') || request()->is('admin/user*') ? 'true' : 'false' }}"
                data-collapse-toggle="dropdown-user">
                <!-- Icon SVG pelanggan -->
                <svg class="w-[31px] h-[31px] {{ request()->is('admin/pelanggan*') || request()->is('admin/user*') ? 'text-white' : 'text-gray-800' }} dark:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                            d="M11 4a1 1 0 0 0-1 1v10h10.459l.522-3H16a1 1 0 1 1 0-2h5.33l.174-1H16a1 1 0 1 1 0-2h5.852l.117-.67v-.003A1.983 1.983 0 0 0 20.06 4H11ZM9 18c0-.35.06-.687.17-1h11.66c.11.313.17.65.17 1v1a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1v-1Zm-6.991-7a17.8 17.8 0 0 0 .953 6.1c.198.54 1.61.9 2.237.9h1.34c.17 0 .339-.032.495-.095a1.24 1.24 0 0 0 .41-.27c.114-.114.2-.25.254-.396a1.01 1.01 0 0 0 .055-.456l-.242-2.185a1.073 1.073 0 0 0-.395-.71 1.292 1.292 0 0 0-.819-.286H5.291c-.12-.863-.17-1.732-.145-2.602-.024-.87.024-1.74.145-2.602H6.54c.302 0 .594-.102.818-.286a1.07 1.07 0 0 0 .396-.71l.24-2.185a1.01 1.01 0 0 0-.054-.456 1.088 1.088 0 0 0-.254-.397 1.223 1.223 0 0 0-.41-.269A1.328 1.328 0 0 0 6.78 4H4.307c-.3-.001-.592.082-.838.238a1.335 1.335 0 0 0-.531.634A17.127 17.127 0 0 0 2.008 11Z"
                            clip-rule="evenodd" />
                    </svg>

                <!-- Teks Produk -->
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Pengguna</span>

                <!-- Icon Dropdown -->
                <svg class="w-3 h-3 {{ request()->is('admin/pelanggan*') || request()->is('admin/user*') ? 'text-white' : 'text-gray-800' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="dropdown-user"
                class="{{ request()->is('admin/user*') || request()->is('admin/pelanggan*') ? '' : 'hidden' }} py-2 space-y-2">
                <li>
                    <a href="{{ url('admin/pelanggan') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/pelanggan') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/user') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/user') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Staff
                    </a>
                </li>
            </ul>

            <li>
                <a href="{{ url('admin/metode_pembayaran') }}"
                    class="flex items-center p-2 text-base font-medium {{ request()->is('admin/metode_pembayaran') || request()->is('admin/metode_pembayaran/create') || request()->is('admin/metode_pembayaran/*/edit') || request()->has('query') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg dark:text-white dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 {{ request()->is('admin/metode_pembayaran') || request()->is('admin/metode_pembayaran/create') || request()->is('admin/metode_pembayaran/*/edit') || request()->has('query') ? 'text-white' : 'text-gray-800' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">Metode Pembayaran</span>
                </a>
            </li>

            <button type="button"
                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->is('admin/transaksi*') || request()->is('admin/detailTransaksi*') ? 'bg-amber-500 text-white' : '' }}"
                aria-controls="dropdown-transaksi"
                aria-expanded="{{ request()->is('admin/transaksi*') || request()->is('admin/detailTransaksi*') ? 'true' : 'false' }}"
                data-collapse-toggle="dropdown-transaksi">
                <!-- Icon SVG transaksi -->
                <svg class="w-[31px] h-[31px] {{ request()->is('admin/transaksi*') || request()->is('admin/detailTransaksi*') ? 'text-white' : 'text-gray-800' }} dark:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M4 4a1 1 0 0 1 1-1h1.5a1 1 0 0 1 .979.796L7.939 6H19a1 1 0 0 1 .979 1.204l-1.25 6a1 1 0 0 1-.979.796H9.605l.208 1H17a3 3 0 1 1-2.83 2h-2.34a3 3 0 1 1-4.009-1.76L5.686 5H5a1 1 0 0 1-1-1Z"
                        clip-rule="evenodd" />
                </svg>

                <!-- Teks Produk -->
                <span class="flex-1 ml-3 text-left whitespace-nowrap">Master Transaksi</span>

                <!-- Icon Dropdown -->
                <svg class="w-3 h-3 {{ request()->is('admin/transaksi*') || request()->is('admin/detailTransaksi*') ? 'text-white' : 'text-gray-800' }}"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="dropdown-transaksi"
                class="{{ request()->is('admin/transaksi*') || request()->is('admin/detailTransaksi*') ? '' : 'hidden' }} py-2 space-y-2">
                <li>
                    <a href="{{ url('admin/transaksi') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/transaksi') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Transaksi
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/detailTransaksi') }}"
                        class="flex items-center w-full p-2 text-base font-medium {{ request()->is('admin/detailTransaksi') ? 'bg-amber-500 text-white hover:bg-amber-500 hover:text-white' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg pl-11 group dark:text-white dark:hover:bg-gray-700">
                        Detail Transaksi
                    </a>
                </li>
            </ul>
            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <li>
                    <a href="/profile"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group {{ request()->is('staff*') ? 'active-sidebar-item' : '' }}">
                        <svg class="w-[31px] h-[31px] text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ml-3">Profile</span>
                    </a>
                </li>
            </ul>
        </ul>
    </div>
</aside>
