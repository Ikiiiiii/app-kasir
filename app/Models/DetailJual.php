<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJual extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail_jual';
    protected $tables = 'detail_juals';
    protected $guarded = [];

    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_kode');
    }
}
