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
        Schema::create('detail_belis', function (Blueprint $table) {
            $table->id('id_detail_beli');
            $table->integer('harga_beli');
            $table->integer('jumlah_beli');
            $table->unsignedBigInteger('pembelian_id');
            $table->string('produk_kode',8);
            $table->foreign('pembelian_id')->references('id_pembelian')->on('pembelians');
            $table->foreign('produk_kode')->references('kode_produk')->on('produks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_belis');
    }
};
