<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'barang_id' => $this->id_barang,
            'kategori_id' => $this->id_kategori,
            'nama' => $this->nama,
            'satuan' => $this->satuan,
            'gambar' => $this->gambar,
            'code_barang' => $this->code_barang,
            'harga_beli' => $this->harga_dasar,
            'harga_jual' => $this->harga_jual,
            'stok' => $this->stok,
            'batas_stok' => $this->batas_stok

        ];
    }
}
