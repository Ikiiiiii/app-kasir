<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'pengguna_id');
    }

    public function penjualan(){
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }

    protected $primaryKey = 'id_pelanggan';
    protected $table = 'pelanggans';
    protected $guarded = [];
}
