<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Stok;
use App\Models\Produk;
use App\Models\MetodeBayar;
use App\Models\Pelanggan;

class Cart extends Component
{
    public $keranjang = [];
    public $totalHarga = 0;
    public $search = '';
    public $id_pelanggan;
    public $id_metode;
    public $metodeBayar = [];
    public $pelanggan = [];
    public $daftarProduk = []; // Menyimpan daftar produk yang akan ditampilkan

    // Method untuk menangani pencarian saat `search` berubah
    public function updatedSearch()
    {
        $this->updateDaftarProduk(); // Update daftar produk berdasarkan pencarian
        $this->render();
    }

    // Method untuk mendapatkan produk berdasarkan pencarian
    private function updateDaftarProduk()
    {
        $this->daftarProduk = Produk::with('stok')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->get();
            \Log::info($this->daftarProduk);
    }

    // Mount method hanya digunakan untuk inisialisasi awal
    public function mount()
    {
        $this->updateDaftarProduk(); // Ambil produk pertama kali saat mount
        $this->metodeBayar = MetodeBayar::all();
        $this->pelanggan = Pelanggan::all();
    }

    public function tambahkanKeKeranjang($idProduk)
    {
        $produk = collect($this->daftarProduk)->firstWhere('id_produk', $idProduk);

        if (!$produk) return;

        if (isset($this->keranjang[$idProduk])) {
            $this->keranjang[$idProduk]['jumlah']++;
        } else {
            $this->keranjang[$idProduk] = [
                'id_produk' => $produk['id_produk'],
                'nama' => $produk['nama'],
                'harga' => $produk['harga'],
                'jumlah' => 1,
                'stok_tersedia' => $produk['stok']['jumlah'] ?? 0,
            ];
        }

        $this->hitungTotalHarga();
        $this->render();
    }

    public function tambahJumlah($idProduk)
    {
        if (isset($this->keranjang[$idProduk]) && $this->keranjang[$idProduk]['stok_tersedia'] > $this->keranjang[$idProduk]['jumlah']) {
            $this->keranjang[$idProduk]['jumlah']++;
            $this->hitungTotalHarga();
            $this->render();
        }
    }

    public function kurangiJumlah($idProduk)
    {
        if (isset($this->keranjang[$idProduk]) && $this->keranjang[$idProduk]['jumlah'] > 1) {
            $this->keranjang[$idProduk]['jumlah']--;
            $this->hitungTotalHarga();
        }
    }

    public function hapusProduk($idProduk)
    {
        if (isset($this->keranjang[$idProduk])) {
            unset($this->keranjang[$idProduk]);
            $this->hitungTotalHarga();
        }
    }

    public function hitungTotalHarga()
    {
        $this->totalHarga = collect($this->keranjang)->sum(fn ($item) => $item['harga'] * $item['jumlah']);
    }

    public function simpan()
    {
        if (empty($this->keranjang)) {
            session()->flash('error_keranjang', 'Keranjang kosong. Tambahkan produk sebelum menyimpan transaksi.');
            return;
        }


        if (!$this->id_pelanggan || !$this->id_metode) {
            session()->flash('error_opsi', 'Pastikan pelanggan dan metode pembayaran dipilih.');
            return;
        }

        \DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'id_pelanggan' => $this->id_pelanggan,
                'id_staff' => auth()->user()->id,
                'id_metode' => $this->id_metode,
                'total_belanja' => $this->totalHarga,
            ]);

            foreach ($this->keranjang as $item) {
                $stok = Stok::where('id_produk', $item['id_produk'])->first();
                if (!$stok || $stok->jumlah < $item['jumlah']) {
                    \DB::rollBack();
                    session()->flash('error_stok', 'Stok produk "' . $item['nama'] . '" tidak cukup. Transaksi gagal.');
                    return;
                }

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $item['id_produk'],
                    'jumlah' => $item['jumlah'],
                    'harga_satuan' => $item['harga'],
                    'total_harga' => $item['jumlah'] * $item['harga'],
                ]);

                $stok->decrement('jumlah', $item['jumlah']);
            }

            \DB::commit();

            $this->keranjang = [];
            $this->totalHarga = 0;

            session()->flash('pesan', 'Transaksi berhasil disimpan!');
            return redirect()->route('admin.detailTransaksi.show', $transaksi->id_transaksi);
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}

