<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = "id_kategori_produk";
    protected $tables = "kategori";
    protected $guarded = [];

    public function produk(){
        return $this->hasMany(Produk::class, 'kategori_produk_id');
    }
}
