<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_diskon_produk';
    protected $tables = 'diskons';
    protected $guarded = [];

    public function produk(){
        return $this->hasMany(Produk::class, 'diskon_produk_id');
    }
}
