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
            $table->string('kode_produk',9)->primary();
            $table->string('nama_produk',64);
            $table->tinyText('gambar_produk');
            $table->integer('harga');
            $table->integer('stok');
            $table->date('tanggal_kadaluarsa');
            $table->unsignedBigInteger('kategori_produk_id');
            $table->unsignedBigInteger('diskon_produk_id')->nullable();
            $table->foreign('kategori_produk_id')->references('id_kategori_produk')->on('kategoris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('diskon_produk_id')->references('id_diskon_produk')->on('diskons')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
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
