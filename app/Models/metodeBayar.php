<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayarans';

    protected $primaryKey = 'id_metode';
    protected $fillable = [
        'nama',
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_metode');
    }
}
