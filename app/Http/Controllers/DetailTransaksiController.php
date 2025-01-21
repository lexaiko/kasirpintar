<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use App\Models\produk;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailTransaksis = DetailTransaksi::with(['produk'])->paginate(10);

        // Log data yang sudah dieksekusi (untuk debugging)
        // \Log::info('Data Produk:', $produks->toArray());
        return view('admin.detail_transaksi.index', compact('detailTransaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $produk = Produk::all();
        $transaksi = transaksi::all();
        return view('admin.detail_transaksi.create', compact('produk', 'transaksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id_transaksi',
            'id_produk' => 'required|exists:produks,id_produk',
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        DetailTransaksi::create($request->all());
        return redirect()->route('admin.detailTransaksi.index')->with('success', 'Detail Trasaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_transaksi)
    {
        $details = DetailTransaksi::with('transaksi')
                    ->where('id_transaksi', $id_transaksi)
                    ->get();

        return view('admin.detail_transaksi.show', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_detail)
    {
        $detail = DetailTransaksi::findOrFail($id_detail);
        $produk = produk::all();
        $transaksi = transaksi::all();
        return view('admin.detail_transaksi.edit', compact('detail', 'produk', 'transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_detail)
    {
        $validated = $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id_transaksi',
            'id_produk' => 'required|exists:produks,id_produk',
            'harga_satuan' => 'required|numeric|min:0',
            'jumlah' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        // Cari detail transaksi berdasarkan id_detail
        $detailTransaksi = DetailTransaksi::findOrFail($id_detail);

        // Update data detail transaksi
        $detailTransaksi->update([
            'id_transaksi' => $validated['id_transaksi'],
            'id_produk' => $validated['id_produk'],
            'harga_satuan' => $validated['harga_satuan'],
            'jumlah' => $validated['jumlah'],
            'total_harga' => $validated['total_harga'],
        ]);

        // Redirect ke halaman detail transaksi dengan pesan sukses
        return redirect()->route('admin.detailTransaksi.index')->with('success', 'Detail transaksi berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_detail)
    {
        $detail = DetailTransaksi::findOrFail($id_detail);
        $detail->delete();
        return redirect()->route('admin.detailTransaksi.index')->with('success', 'Detai Ttrasaksi berhasil dihapus.');
    }
}
