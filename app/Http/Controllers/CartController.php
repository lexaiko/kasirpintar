<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class TransaksiController extends Controller
{
    public function create()
    {
        $produks = Produk::all();
        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produks,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        \DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total_bayar' => 0,
                'status' => 'selesai',
                'user_id' => auth()->id(),
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);

            $totalBayar = 0;

            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];
                $totalHarga = $produk->harga * $jumlah;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $produk->harga,
                    'total_harga' => $totalHarga,
                ]);

                $totalBayar += $totalHarga;
            }

            $transaksi->update(['total_bayar' => $totalBayar]);

            \DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
