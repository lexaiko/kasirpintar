<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StokResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_stok' => $this->id_stok,
            'produk' => [
                'id_produk' => $this->produk->id_produk ?? null,
                'nama_produk' => $this->produk->nama ?? null,
            ],
            'jumlah' => $this->jumlah,
            'satuan' => [
                'id_satuan' => $this->satuan->id_satuan ?? null,
                'nama_satuan' => $this->satuan->nama ?? null,
            ],
        ];
    }
}

