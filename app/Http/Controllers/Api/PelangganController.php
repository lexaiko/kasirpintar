<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PelangganResource;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return PelangganResource::collection($pelanggan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelanggan' => 'required|string|max:255|unique:pelanggan',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Pelanggan::create($request->all());
        return response()->json(['message' => 'Pelanggan created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan not found'], 404);
        }

        return new PelangganResource($pelanggan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_pelanggan' => 'required|string|max:255|unique:pelanggan,id_pelanggan,' . $id,
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pelanggan->update($request->all());
        return new PelangganResource($pelanggan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json(['message' => 'Pelanggan not found'], 404);
        }

        $pelanggan->delete();
        return response()->json(['message' => 'Pelanggan deleted successfully']);
    }
}

