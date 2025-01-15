<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metodeBayar extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayarans';

    protected $fillable = [
        'nama',
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_metode');
    }
}
