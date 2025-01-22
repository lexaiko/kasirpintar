<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShowTransaksiResource;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class ShowTransaksiController extends Controller
{
    public function show($id)
    {
        $detailTransaksi = DetailTransaksi::with('transaksi')->where('id_transaksi', $id)->get();

        if (!$detailTransaksi) {
            return response()->json(['message' => 'Detail Transaksi not found'], 404);
        }

        return new ShowTransaksiResource($detailTransaksi);
    }
}
