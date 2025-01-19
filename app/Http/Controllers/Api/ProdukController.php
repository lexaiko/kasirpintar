<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(['kategori', 'merek', 'satuan', 'stok'])->get();
        return ProdukResource::collection($produks);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'id_satuan' => 'required|integer',
            'id_merek' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        $data = $request->all();
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        Produk::create($data);
        return response()->json(['message' => 'Produk created successfully'], 201);
        // return new BarangResource($data);
    }

    // Display the specified resource
    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'produk not found'], 404);
        }

        return new ProdukResource($produk);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'produk not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'id_satuan' => 'required|integer',
            'id_merek' => 'required|integer',
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $produk->update($data);
        return response()->json(['message' => 'Produk updated successfully', 'data' => new ProdukResource($produk)], 200);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return response()->json(['message' => 'produk not found'], 404);
        }

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();
        return response()->json(['message' => 'produk deleted successfully']);
    }
}
