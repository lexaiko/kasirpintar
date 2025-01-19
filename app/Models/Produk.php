<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    protected $fillable = ['id_kategori', 'id_satuan', 'id_merek', 'nama', 'harga', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'id_merek', 'id_merek');
    }
    public function stok()
    {
        return $this->hasOne(Stok::class, 'id_produk', 'id_produk');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk');
    }
}

