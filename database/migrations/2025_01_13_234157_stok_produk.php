<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id('id_stok'); // Primary key
            $table->unsignedBigInteger('id_produk'); // Foreign key ke tabel produk
            $table->integer('jumlah'); // Jumlah stok
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
        });
    }

    /**
     * Membalikkan migrasi untuk menghapus tabel stok.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stok');
    }
};
