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
        Schema::create('detail_juals', function (Blueprint $table) {
            $table->id('id_detail_jual');
            $table->integer('jumlah_produk');
            $table->integer('harga_jual')->nullable();
            $table->unsignedBigInteger('penjualan_id');
            $table->string('produk_kode',9)->nullable();
            $table->foreign('penjualan_id')->references('id_penjualan')->on('penjualans')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('produk_kode')->references('kode_produk')->on('produks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_juals');
    }
};
