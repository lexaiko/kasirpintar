<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\MetodeBayar;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;

class CartController extends Controller
{
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produks = Produk::all();
        $metode = MetodeBayar::all();
        return view('kasir', compact('produks', 'pelanggan', 'metode'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
        'id_produk' => 'required|array',
        'id_produk.*' => 'exists:produks,id_produk',
        'id_metode' => 'required|',
        'jumlah' => 'required|array',
        'jumlah.*' => 'integer|min:1',
    ]);

    DB::beginTransaction();

    try {
        // Buat data transaksi baru
        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan, // Pelanggan dari user yang login
            'id_staff' => auth()->id(), // Staf yang membuat transaksi
            'id_metode' => $request->id_metode, // Metode pembayaran
            'total_belanja' => 0, // Akan diperbarui nanti
        ]);

        // Log transaksi yang baru dibuat
        \Log::info("Transaksi baru dibuat: ", $transaksi->toArray());

        $totalBelanja = 0;

        // Loop untuk setiap produk yang ditambahkan ke transaksi
        foreach ($request->id_produk as $index => $produkId) {
            $produk = Produk::findOrFail($produkId); // Temukan produk berdasarkan id

            $jumlah = $request->jumlah[$index]; // Jumlah yang dibeli
            $totalHarga = $produk->harga * $jumlah; // Total harga = harga satuan * jumlah

            // Log informasi produk yang sedang diproses
            \Log::info("Memproses produk: {$produk->nama}, Jumlah: {$jumlah}, Harga Satuan: Rp " . number_format($produk->harga));

            // Cek apakah stok cukup
            if ($produk->stok < $jumlah) {
                throw new \Exception("Stok produk '{$produk->nama}' tidak mencukupi. Stok tersedia: {$produk->stok}");
            }

            // Buat data detail transaksi
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi, // Foreign key ke transaksi
                'id_produk' => $produk->id_produk, // Foreign key ke produk
                'jumlah' => $jumlah,
                'harga_satuan' => $produk->harga,
                'total_harga' => $totalHarga,
            ]);

            // Log pengurangan stok
            \Log::info("Mengurangi stok produk: {$produk->nama}, Stok yang tersedia sebelum: {$produk->stok}, Stok yang dikurangi: {$jumlah}");

            // Kurangi stok produk
            $produk->update(['stok' => $produk->stok - $jumlah]);

            // Log setelah stok diperbarui
            \Log::info("Stok produk setelah diperbarui: {$produk->nama}, Stok yang tersedia sekarang: {$produk->stok}");

            // Tambahkan total harga ke total belanja
            $totalBelanja += $totalHarga;
        }

        // Perbarui total belanja di transaksi
        $transaksi->update(['total_belanja' => $totalBelanja]);

        // Log total belanja yang diperbarui
        \Log::info("Total belanja diperbarui: Rp " . number_format($totalBelanja));

        \DB::commit();

        // Log transaksi berhasil
        \Log::info("Transaksi berhasil disimpan: ", $transaksi->toArray());
        \Log::info("Data detail transaksi: ", $transaksi->detailTransaksi->toArray());

        return redirect()->route('kasir')->with('success', 'Transaksi berhasil disimpan!');
    } catch (\Exception $e) {
        \DB::rollBack();

        // Log error yang terjadi
        \Log::error("Error saat menyimpan transaksi: " . $e->getMessage());

        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


}

