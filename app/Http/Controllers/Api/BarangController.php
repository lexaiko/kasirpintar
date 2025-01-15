<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return BarangResource::collection($barangs);
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'nama' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'gambar' => 'nullable|string',
            'code_barang' => 'required|string|unique:barangs',
            'harga_dasar' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'batas_stok' => 'required|integer',
        ]);

        $data = $request->all();
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Barang::create($data);
        return response()->json(['message' => 'Barang created successfully'], 201);
        // return new BarangResource($data);
    }

    // Display the specified resource
    public function show($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        return new BarangResource($barang);
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_kategori' => 'nullable|integer',
            'nama' => 'nullable|string|max:255',
            'satuan' => 'nullable|string|max:50',
            'gambar' => 'nullable|string',
            'code_barang' => 'nullable|string|unique:barangs,code_barang,' . $id,
            'harga_dasar' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
            'stok' => 'nullable|integer',
            'batas_stok' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $barang->update($request->all());
        return new BarangResource($barang);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        $barang->delete();
        return response()->json(['message' => 'Barang deleted successfully']);
    }
}
