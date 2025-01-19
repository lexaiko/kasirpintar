<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transaksi_id' => $this->id_transaksi,
            'pelanggan' => [
                'id_pelanggan' => $this->pelanggan->id_pelanggan ?? null,
                'nama_pelanggan' => $this->pelanggan->nama ?? null,
            ],
            'staff' => [
                'id_staff' => $this->user->id ?? null,
                'nama_staff' => $this->user->name ?? null,
            ],
            'metode' => [
                'id_metode' => $this->metodeBayar->id_metode ?? null,
                'nama_metode' => $this->metodeBayar->nama ?? null,
            ],
            'total_belanja' => $this->total_belanja,
        ];
    }
}

