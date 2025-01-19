<?php

namespace App\Http\Controllers\api;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Resources\TransaksiResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'user', 'metodeBayar'])->get();
        return TransaksiResource::collection($transaksis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pelanggan' => 'required|integer',
            'id_staff' => 'required|integer',
            'id_metode' => 'required|integer',
            'total_belanja' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Transaksi::create($request->all());
        return response()->json(['message' => 'Transaksi created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }

        return new TransaksiResource($transaksi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_pelanggan' => 'required|integer',
            'id_staff' => 'required|integer',
            'id_metode' => 'required|integer',
            'total_belanja' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $transaksi->update($request->all());
        return new TransaksiResource($transaksi);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }

        $transaksi->delete();
        return response()->json(['message' => 'Transaksi deleted successfully']);
    }
}

