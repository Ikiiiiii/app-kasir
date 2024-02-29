<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pembelian;
use App\Models\DetailBeli;
use Illuminate\Support\Facades\Session;

class PembelianController extends Controller
{
    //
    public function index(){
        $data['produk'] = Produk::all();
        $data['detail'] = DetailBeli::all(); 
        return view('admin.pembelian',$data);
    }

    public function create(Request $req){
        $req->validate([
            'produk_kode' => 'required',
            'harga_beli' => 'required',
            'jumlah_beli' => 'required',
        ]);

        $pembelian = Pembelian::create();

        if($pembelian){
            $detail = DetailBeli::create([
                'produk_kode' => $req->produk_kode,
                'harga_beli' => $req->harga_beli,
                'jumlah_beli' => $req->jumlah_beli,
                'pembelian_id' => $pembelian->id_pembelian
            ]);

            if($detail){
                Session::flash('pesan','Data berhasil ditambahkan');
                return redirect('/pembelian');
            }else{
                Session::flash('pesan','Data gagal ditambahkan');
                return redirect()->back();
            }
        }
    }
}
