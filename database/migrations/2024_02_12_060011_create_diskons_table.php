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
        Schema::create('diskons', function (Blueprint $table) {
            $table->id('id_diskon_produk');
            $table->string('nama_diskon',64);
            $table->enum('jenis_diskon',['Persentase','Nominal']);
            $table->integer('nilai_diskon');
            $table->string('deskripsi',45);
            $table->date('berlaku_mulai');
            $table->date('berlaku_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
