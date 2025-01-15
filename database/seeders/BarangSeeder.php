<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'id_kategori' => 1, // Elektronik
                'nama' => 'Laptop',
                'satuan' => 'Unit',
                'gambar' => 'laptop.jpg',
                'code_barang' => 'ELEK001',
                'harga_dasar' => 10000000,
                'harga_jual' => 12000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 1, // Elektronik
                'nama' => 'Smartphone',
                'satuan' => 'Unit',
                'gambar' => 'smartphone.jpg',
                'code_barang' => 'ELEK002',
                'harga_dasar' => 5000000,
                'harga_jual' => 4200000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 3, // Makanan
                'nama' => 'Biskuit',
                'satuan' => 'Pack',
                'gambar' => 'biskuit.jpg',
                'code_barang' => 'MAKAN001',
                'harga_dasar' => 12000,
                'harga_jual' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 4, // Minuman
                'nama' => 'Air Mineral',
                'satuan' => 'Botol',
                'gambar' => 'air_mineral.jpg',
                'code_barang' => 'MINUM001',
               'harga_dasar' => 5000,
                'harga_jual' => 6000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_kategori' => 5, // Peralatan Rumah Tangga
                'nama' => 'Setrika',
                'satuan' => 'Unit',
                'gambar' => 'setrika.jpg',
                'code_barang' => 'RUMAH001',
               'harga_dasar' => 200000,
                'harga_jual' => 250000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
