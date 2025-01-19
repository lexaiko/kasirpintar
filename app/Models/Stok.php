<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stok extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi plural
    protected $table = 'stoks';

    // Menentukan primary key jika tidak menggunakan konvensi "id"
    protected $primaryKey = 'id_stok';

    // Menentukan kolom yang bisa diisi (fillable)
    protected $fillable = [
        'id_produk',
        'jumlah',
    ];

    /**
     * Relasi Belongs-To dengan Produk
     * Setiap entri stok berhubungan dengan satu produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
