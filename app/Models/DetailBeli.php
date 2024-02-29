<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBeli extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail_beli';
    protected $tables = 'detail_beli';
    protected $guarded = [];

    public function pembelian(){
        return $this->belongsTo(Pembelian::class, 'pembelian_id');
    }

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_kode');
    }
}
