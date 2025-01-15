<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_satuan');
            $table->unsignedBigInteger('id_merek');
            $table->string('nama');
            $table->decimal('harga', 15, 2);
            $table->integer('stok');
            $table->string('gambar');
            $table->timestamps();




            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade');
            $table->foreign('id_satuan')->references('id_satuan')->on('satuans')->onDelete('cascade');
            $table->foreign('id_merek')->references('id_merek')->on('mereks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
