<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';
    protected $primaryKey = 'id_satuan';

    protected $fillable = ['nama'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_satuan', 'id_satuan');
    }
}
