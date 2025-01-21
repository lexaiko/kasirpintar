<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks = Stok::with('produk')->paginate(5);
        return view('admin.stok.index', compact('stoks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('admin.stok.create' , compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk|unique:stoks,id_produk',
            'jumlah' => 'required|numeric|min:1',
        ]);

        Stok::create($request->all());
        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $stok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_stok)
    {
        $stok = Stok::findOrFail($id_stok);
        return view('admin.stok.edit', compact('stok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_stok)
    {
        $validatedData = $request->validate([
            'jumlah' => 'required|numeric|min:1',
        ]);

        $stok = Stok::find($id_stok);
        $stok->update($validatedData);

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diperbarui.');
    }

    public function tambah(Request $request, $id_stok)
    {
        $validatedData = $request->validate([
            'jumlah_tambah' => 'required|numeric|min:1',
        ]);

        $stok = Stok::find($id_stok);
        $stok->jumlah += $validatedData['jumlah_tambah'];
        $stok->save();

        \Log::info('Stok updated', ['id_stok' => $id_stok, 'jumlah_tambah' => $validatedData['jumlah_tambah']]);

        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_stok)
    {
        $stok = Stok::findOrFail($id_stok);
        $stok->delete();
        return redirect()->route('admin.stok.index')->with('success', 'Stok berhasil dihapus.');
    }
}

