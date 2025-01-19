<?php

namespace App\Http\Controllers\api;

use App\Models\Stok;
use Illuminate\Http\Request;
use App\Http\Resources\StokResource;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoks = Stok::with('produk')->get();
        return StokResource::collection($stoks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Stok::create($request->all());
        return response()->json(['message' => 'Stok created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json(['message' => 'Stok not found'], 404);
        }

        return new StokResource($stok);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json(['message' => 'Stok not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_produk' => 'required|integer',
            'jumlah' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $stok->update($request->all());
        return new StokResource($stok);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json(['message' => 'Stok not found'], 404);
        }

        $stok->delete();
        return response()->json(['message' => 'Stok deleted successfully']);
    }
}

