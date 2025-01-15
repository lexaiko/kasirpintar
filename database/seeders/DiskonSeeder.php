<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('diskons')->insert([
            'id_barang' => 1, // Sesuaikan dengan id_barang yang valid di tabel barangs
            'presentase' => 10.00, // Presentase diskon 10%
            'tgl_mulai' => Carbon::today()->toDateString(), // Tanggal mulai diskon (hari ini)
            'tgl_selesai' => Carbon::today()->addWeek()->toDateString(), // Tanggal selesai diskon (7 hari ke depan)
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
