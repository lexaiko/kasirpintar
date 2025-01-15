<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $fillable = [
        'id_pelanggan',
        'id_staff',
        'id_metode',
        'total_belanja',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_staff');
    }

    // Relasi dengan tabel pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Relasi dengan tabel metode bayar
    public function metodeBayar()
    {
        return $this->belongsTo(MetodeBayar::class, 'id_metode');
    }

    // Relasi dengan tabel detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}
