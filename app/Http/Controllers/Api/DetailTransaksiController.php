<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailTransaksiResource;
use App\Models\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailTransaksis = DetailTransaksi::all();
        return DetailTransaksiResource::collection($detailTransaksis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|integer',
            'id_produk' => 'required|integer',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DetailTransaksi::create($request->all());
        return response()->json(['message' => 'Detail Transaksi created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailTransaksi = DetailTransaksi::find($id);

        if (!$detailTransaksi) {
            return response()->json(['message' => 'Detail Transaksi not found'], 404);
        }

        return new DetailTransaksiResource($detailTransaksi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detailTransaksi = DetailTransaksi::find($id);

        if (!$detailTransaksi) {
            return response()->json(['message' => 'Detail Transaksi not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|integer',
            'id_produk' => 'required|integer',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $detailTransaksi->update($request->all());
        return new DetailTransaksiResource($detailTransaksi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailTransaksi = DetailTransaksi::find($id);

        if (!$detailTransaksi) {
            return response()->json(['message' => 'Detail Transaksi not found'], 404);
        }

        $detailTransaksi->delete();
        return response()->json(['message' => 'Detail Transaksi deleted successfully']);
    }
}

