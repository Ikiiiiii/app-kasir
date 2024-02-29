<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penjualan';
    protected $tables = 'penjualans';
    protected $guarded = [];

    public function detailjual(){
        return $this->hasMany(DetailJual::class, 'penjualan_id');
    }

    public function pengiriman(){
        return $this->hasMany(Pengiriman::class, 'penjualan_id');
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
