<?php

namespace App\Http\Controllers\api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return KategoriResource::collection($kategoris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Kategori::create($request->all());
        return response()->json(['message' => 'Kategori created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }

        return new KategoriResource($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kategori->update($request->all());
        return new KategoriResource($kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Kategori not found'], 404);
        }

        $kategori->delete();
        return response()->json(['message' => 'Kategori deleted successfully']);
    }
}

