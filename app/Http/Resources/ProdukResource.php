<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id_produk' => $this->id_produk,
            'nama' => $this->nama,
            'kategori' => [
                'id_kategori' => $this->kategori->id_kategori ?? null,
                'nama_kategori' => $this->kategori->nama ?? null,
            ],
            'merek' => [
                'id_merek' => $this->merek->id_merek ?? null,
                'nama_merek' => $this->merek->nama ?? null,
            ],
            'satuan' => [
                'id_satuan' => $this->satuan->id_satuan ?? null,
                'nama_satuan' => $this->satuan->nama ?? null,
            ],
            'harga' => $this->harga,
            'stok' => [
                'id_stok' => $this->stok->id_stok ?? null,
                'jumlah_stok' => $this->stok->jumlah ?? null,
            ],
            'gambar' => 'http://127.0.0.1:8000/storage/' . $this->gambar

        ];
    }
}
