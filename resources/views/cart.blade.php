@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Transaksi Pembelian</h1>
    <div class="flex space-x-6">
        <!-- Barang yang dipilih -->
        <div class="w-1/2 bg-gray-100 p-4 rounded-md">
            <h2 class="text-lg font-bold mb-4">Keranjang</h2>
            <div id="selected-items" class="space-y-4">
                <p class="text-gray-500">Belum ada barang dipilih.</p>
            </div>
        </div>

        <!-- Daftar Barang -->
        <div class="w-1/2 bg-white shadow-md p-4 rounded-md">
            <h2 class="text-lg font-bold mb-4">Daftar Barang</h2>
            <div id="item-list" class="space-y-4">
                <div class="item border p-4 rounded-md flex justify-between items-center">
                    <div>
                        <p class="font-medium">Kopi</p>
                        <p class="text-sm text-gray-500">Rp 10,000</p>
                    </div>
                    <button type="button" class="add-to-cart bg-blue-600 text-white px-3 py-1 rounded-md" data-id="1" data-name="Kopi" data-price="10000">Tambah</button>
                </div>
                <div class="item border p-4 rounded-md flex justify-between items-center">
                    <div>
                        <p class="font-medium">Macha</p>
                        <p class="text-sm text-gray-500">Rp 15,000</p>
                    </div>
                    <button type="button" class="add-to-cart bg-blue-600 text-white px-3 py-1 rounded-md" data-id="2" data-name="Macha" data-price="15000">Tambah</button>
                </div>
                <div class="item border p-4 rounded-md flex justify-between items-center">
                    <div>
                        <p class="font-medium">Latte</p>
                        <p class="text-sm text-gray-500">Rp 12,000</p>
                    </div>
                    <button type="button" class="add-to-cart bg-blue-600 text-white px-3 py-1 rounded-md" data-id="3" data-name="Latte" data-price="12000">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <div class="mt-6">
        <button type="button" id="save-transaction" class="bg-green-600 text-white px-4 py-2 rounded-md">Simpan Transaksi</button>
        <pre id="transaction-json" class="mt-4 p-2 bg-gray-100 rounded-md overflow-x-auto"></pre>
    </div>
</div>

<script>
    const selectedItemsContainer = document.getElementById('selected-items');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const saveTransactionButton = document.getElementById('save-transaction');
    const transactionJsonElement = document.getElementById('transaction-json');

    // Menyimpan barang yang dipilih
    const selectedItems = {};

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const price = button.getAttribute('data-price');

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
        });
    });

    function renderSelectedItems() {
        selectedItemsContainer.innerHTML = '';

        Object.values(selectedItems).forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'flex justify-between items-center border p-2 rounded-md';

            itemElement.innerHTML = `
                <div>
                    <p class="font-medium">${item.name}</p>
                    <p class="text-sm text-gray-500">Rp ${Number(item.price).toLocaleString()}</p>
                </div>
                <div class="flex items-center">
                    <input type="number" class="quantity-input border px-2 py-1 w-16 text-center" data-id="${item.id}" value="${item.quantity}" min="1">
                    <button type="button" class="remove-item text-red-600 ml-2" data-id="${item.id}">Hapus</button>
                </div>
            `;

            selectedItemsContainer.appendChild(itemElement);

            itemElement.querySelector('.quantity-input').addEventListener('input', e => {
                const id = e.target.getAttribute('data-id');
                const quantity = parseInt(e.target.value);

                if (quantity > 0) {
                    selectedItems[id].quantity = quantity;
                } else {
                    selectedItems[id].quantity = 1;
                    e.target.value = 1;
                }
            });

            itemElement.querySelector('.remove-item').addEventListener('click', e => {
                const id = e.target.getAttribute('data-id');
                delete selectedItems[id];
                renderSelectedItems();
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
</script>

