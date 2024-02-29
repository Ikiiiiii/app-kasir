<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pembelian';
    protected $tables = 'pembelian';
    protected $guarded = [];

    public function detailbeli(){
        return $this->hasMany(DetailBeli::class, 'pembelian_id');
    }
}
