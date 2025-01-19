<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\metodeBayar;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HCartController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        $metode = MetodeBayar::all();

        return view('cart', compact('produk', 'pelanggan', 'metode'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_metode' => 'required|exists:metode_pembayarans,id_metode',
            'items' => 'required|array',
            'items.*.id_produk' => 'required|exists:produks,id_produk',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|integer|min:1',
        ]);
        try {
            Log::info('Request Data:', $request->all());
        } catch (\Exception $e) {
            // Tangani kesalahan log di sini jika perlu
            Log::error('Logging failed: ' . $e->getMessage());
        }

        $totalBelanja = collect($request->items)->reduce(function ($carry, $item) {
            return $carry + ($item['jumlah'] * $item['harga_satuan']);
        }, 0);

        // Simpan data transaksi
        $transaksi = Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_metode' => $request->id_metode,
            'id_staff' => Auth::id(),
            'total_belanja' => $totalBelanja,
        ]);

        if (!$transaksi || !$transaksi->id) {
            Log::error('Transaksi tidak berhasil dibuat');
            return response()->json([
                'message' => 'Terjadi kesalahan dalam menyimpan transaksi',
            ], 500);
        }

        // Simpan detail transaksi
        foreach ($request->items as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $item['id_produk'],
                'jumlah' => $item['jumlah'],
                'harga_satuan' => $item['harga_satuan'],
                'total_harga' => $item['jumlah'] * $item['harga_satuan'],
            ]);
        }

        return response()->json([
            'message' => 'Transaksi berhasil disimpan.',
            'data' => $transaksi,
        ]);
    }
}
