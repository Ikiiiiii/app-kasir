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
        Schema::create('pengirimen', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->date('tanggal_pengiriman');
            $table->string('biaya_pengiriman',46);
            $table->enum('status_pengiriman', ['Dikemas','Dikirim','Selesai','Dibatalkan']);
            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('penjualan_id')->references('id_penjualan')->on('penjualans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimen');
    }
};
