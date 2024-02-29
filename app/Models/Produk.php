<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_produk';
    protected $tables = 'produks';
    public $incrementing = false;
    protected $guarded = [];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_produk_id');
    }

    public function diskon(){
        return $this->belongsTo(Diskon::class, 'diskon_produk_id');
    }

    public function detailbeli(){
        return $this->hasMany(DetailBeli::class, 'produk_kode');
    }

    public function detailjual(){
        return $this->hasMany(DetailJual::class, 'produk_kode');
    }
}
