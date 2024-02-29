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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->string('kode_transaksi',8);
            $table->dateTime('tanggal_jual')->default(now());
            $table->enum('metode_pembayaran', ['Transfer','COD']);
            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id_pelanggan')->on('pelanggans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
