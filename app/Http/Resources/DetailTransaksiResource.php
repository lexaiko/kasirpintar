<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailTransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'detail_transaksi_id' => $this->id_detail,
            'transaksi' => [
                'id_transaksi' => $this->transaksi->id_transaksi ?? null,
                'nama_pelanggan' => $this->transaksi->pelanggan->nama ?? null,
            ],
            'produk' => [
                'id_produk' => $this->produk->id_produk ?? null,
                'nama_produk' => $this->produk->nama ?? null,
            ],
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'total_harga' => $this->total_harga,
        ];
    }
}

