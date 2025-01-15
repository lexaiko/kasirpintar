<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_barang')->insert([
            ['id_kategori' => 1, 'kategori' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori' => 2, 'kategori' => 'Pakaian', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori' => 3, 'kategori' => 'Makanan', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori' => 4, 'kategori' => 'Minuman', 'created_at' => now(), 'updated_at' => now()],
            ['id_kategori' => 5, 'kategori' => 'Peralatan Rumah Tangga', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
