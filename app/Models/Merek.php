<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Merek extends Model
{
    use HasFactory;

    protected $table = 'mereks';
    protected $primaryKey = 'id_merek';

    protected $fillable = ['nama'];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_merek', 'id_merek');
    }
}
