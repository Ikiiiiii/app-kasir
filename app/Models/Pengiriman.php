<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pengiriman';
    protected $tables = 'pengirimen';
    protected $guarded = [];

    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }
}
