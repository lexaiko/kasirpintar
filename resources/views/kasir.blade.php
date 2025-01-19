@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Transaksi Pembelian</h1>
    <form action="{{ route('kasir.store') }}" method="post">
        @csrf
        <input type="hidden" name="id_transaksi" value="1">
        <input type="hidden" name="id_produk" value="6">
        <input type="hidden" name="jumlah" value="5">
        <input type="hidden" name="harga_satuan" value="100000">
        <input type="hidden" name="total_harga" value="2001000">
        <div class="grid gap-2 sm:grid-cols-2 sm:gap-2">
            <div class="sm:col-span-1">
                <label for="id_pelanggan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pelanggan</label>
                <select id="id_pelanggan" name="id_pelanggan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_pelanggan') is-invalid @enderror">
                    @foreach ($pelanggan as $k)
                        <option value="{{ $k->id_pelanggan }}"
                            {{ old('id_pelanggan') == $k->id_pelanggan ? 'selected' : '' }}>{{ $k->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_pelanggan')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="sm:col-span-1">
                <label for="id_metode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metode
                    Pembayaran</label>
                <select id="id_metode" name="id_metode"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('id_metode') is-invalid @enderror">
                    @foreach ($metode as $k)
                        <option value="{{ $k->id_metode }}" {{ old('id_metode') == $k->id_metode ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_metode')
                    <div class="invalid-feedback text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

    </form>
        <div class="flex space-x-6 mt-6">
            <!-- Barang yang dipilih -->
            <div class="w-1/2 bg-gray-100 p-4 rounded-md">
                <h2 class="text-lg font-bold mb-4">Keranjang</h2>
                <div id="selected-items" class="space-y-4">
                    <p class="text-gray-500">Belum ada barang dipilih.</p>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="w-1/2 bg-white shadow-md p-4 rounded-md">
                {{-- <h2 class="text-lg font-bold mb-4">Daftar Barang</h2>
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
            </div> --}}
                <div id="item-list" class="space-y-4 overflow-y-auto max-h-[300px]">
                    @foreach ($produks as $p)
                        <div class="item border p-4 rounded-md flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $p->nama }}</p>
                                <p class="text-sm text-gray-500">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                            </div>
                            <button type="button" class="add-to-cart bg-blue-600 text-white px-3 py-1 rounded-md"
                                data-id="{{ $p->id_produk }}" data-name="{{ $p->nama }}"
                                data-price="{{ $p->harga }}">Tambah</button>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <h4 class="font-medium item border p-4 rounded-md flex justify-between items-center">
                Total belanja
                <span class="ml-auto text-right">Rp. <span id="total-bill">0</span></span>
            </h4>
        </div>

        <!-- Tombol Simpan -->
        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md">Simpan Transaksi</button>
        </div>

</div>

<script>
    const selectedItemsContainer = document.getElementById('selected-items');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const saveTransactionButton = document.getElementById('save-transaction');
    const totalBillElement = document.getElementById('total-bill');

    // Menyimpan barang yang dipilih
    const selectedItems = {};

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const price = parseInt(button.getAttribute('data-price'));

            if (!selectedItems[id]) {
                selectedItems[id] = {
                    id,
                    name,
                    price,
                    quantity: 1
                };

                renderSelectedItems();
            } else {
                selectedItems[id].quantity += 1;
                updateQuantity(id);
            }

            updateTotalBill();
        });
    });

    function renderSelectedItems() {
        selectedItemsContainer.innerHTML = '';

        Object.values(selectedItems).forEach(item => {
            const totalHarga = item.price * item.quantity;

            const itemElement = document.createElement('div');
            itemElement.className = 'flex justify-between items-center border p-2 rounded-md';

            itemElement.innerHTML = `
            <div>
                <p class="font-medium">${item.name}</p>
                <p class="text-sm text-gray-500">Rp ${Number(item.price).toLocaleString()}</p>
            </div>
            <div class="flex items-center">
                <input type="number" name="jumlah[]" class="quantity-input border px-2 py-1 w-16 text-center" data-id="${item.id}" value="${item.quantity}" min="1">
                <p class="font-medium mx-2">Rp ${Number(totalHarga).toLocaleString()}</p>
                <button type="button" class="remove-item text-red-600 ml-2" data-id="${item.id}">Hapus</button>
            </div>
        `;

            selectedItemsContainer.appendChild(itemElement);

            const quantityInput = itemElement.querySelector('.quantity-input');
            const totalHargaElement = itemElement.querySelector('.font-medium.mx-2');

            quantityInput.addEventListener('input', e => {
                const id = e.target.getAttribute('data-id');
                const quantity = parseInt(e.target.value);

                if (quantity > 0) {
                    selectedItems[id].quantity = quantity;
                    totalHargaElement.textContent =
                        `Rp ${Number(selectedItems[id].price * quantity).toLocaleString()}`;
                } else {
                    selectedItems[id].quantity = 1;
                    e.target.value = 1;
                    totalHargaElement.textContent =
                        `Rp ${Number(selectedItems[id].price).toLocaleString()}`;
                }

                updateTotalBill();
            });

            itemElement.querySelector('.remove-item').addEventListener('click', e => {
                const id = e.target.getAttribute('data-id');
                delete selectedItems[id];
                renderSelectedItems();
                updateTotalBill();
            });
        });

        if (Object.keys(selectedItems).length === 0) {
            selectedItemsContainer.innerHTML = '<p class="text-gray-500">Belum ada barang dipilih.</p>';
        }
    }

    saveTransactionButton.addEventListener('click', () => {
        const transactionData = Object.values(selectedItems);
        transactionJsonElement.textContent = JSON.stringify(transactionData, null, 2);
    });

    function updateQuantity(id) {
        const input = selectedItemsContainer.querySelector(`.quantity-input[data-id="${id}"]`);
        if (input) {
            input.value = selectedItems[id].quantity;
        }
    }

    function updateTotalBill() {
        const total = Object.values(selectedItems).reduce((sum, item) => sum + item.price * item.quantity, 0);
        totalBillElement.textContent = Number(total).toLocaleString();
    }
</script>
