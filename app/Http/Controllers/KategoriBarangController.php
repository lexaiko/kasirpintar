<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriBarang::all();
        return view('manajemen.kategori_barang.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen.kategori_barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        KategoriBarang::create($request->all());
        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriBarang $kategori)
    {
        return view('manajemen.kategori_barang.show', compact('kategori'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBarang $kategori)
    {
        return view('manajemen.kategori_barang.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategori)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori_barang.index')->with('success', 'Kategori berhasil dihapus.');

    }
}
