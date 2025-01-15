<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use App\Models\Produk;
use App\Models\Satuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with(['kategori', 'merek', 'satuan'])->paginate(5);

        // Log data yang sudah dieksekusi (untuk debugging)
        // \Log::info('Data Produk:', $produks->toArray());
        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $merek = Merek::all();
        return view('admin.produk.create', compact('kategori', 'satuan', 'merek'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_satuan' => 'required|exists:satuans,id_satuan',
            'id_merek' => 'required|exists:mereks,id_merek',
            'nama' => 'required',
            'gambar' => 'nullable|image',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        Produk::create($data);
        return redirect()->route('admin.produk.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return view('manajemen.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_produk)
{
    $produk = Produk::findOrFail($id_produk);
    $kategori = Kategori::all();
    $merek = Merek::all();
    $satuan = Satuan::all();
    return view('admin.produk.edit', compact('produk', 'kategori', 'merek', 'satuan'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_produk)
{
    try {
        // Ambil data produk berdasarkan id
        $produk = Produk::find($id_produk);
        if (!$produk) {
            return redirect()->back()->withErrors('Produk tidak ditemukan.');
        }

        // Validasi input
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'id_satuan' => 'required|exists:satuans,id_satuan',
            'id_merek' => 'required|exists:mereks,id_merek',
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:22048',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        // Update produk
        $produk->update($validatedData);

        \Log::info("Produk berhasil diperbarui: ", $produk->toArray());

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
    } catch (\Exception $e) {
        \Log::error("Error saat memperbarui produk: " . $e->getMessage());
        return redirect()->back()->withErrors('Terjadi kesalahan: ' . $e->getMessage());
    }
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_produk)
    {

        // \Log::info("ID Barang yang akan dihapus: " . $id_produk);
        $product = Produk::findOrFail($id_produk);
        $product->delete();
        return redirect()->route('admin.produk.index')->with('success', 'Barang berhasil dihapus.');
    }
}
