<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\Session;

class PengirimanController extends Controller
{
    //
    public function index(){
        $data['penjualan'] = Penjualan::all();
        $data['pengiriman'] = Pengiriman::all();
        $data['status'] = ['Dikemas', 'Dikirim', 'Selesai', 'Dibatalkan'];
        return view('admin.pengiriman',$data);
    }

    public function create(Request $req){
        $pengiriman = $req->validate([
            'tanggal_pengiriman' => 'required',
            'biaya_pengiriman' => 'required',
            'status_pengiriman' => 'required',
            'penjualan_id' => 'required'
        ]);
        $pengirimen = Pengiriman::create($pengiriman);
        if($pengirimen){
            Session::flash('pesan','Data berhasil ditambahkan');
        }else{
            Session::flash('pesan','Data gagal ditambahkan');
        }
        return redirect('pengiriman');
    }

    public function update(Request $req){
        $validate = $req->validate([
            'tanggal_pengiriman' => 'required',
            'biaya_pengiriman' => 'required',
            'status_pengiriman' => 'required',
            'penjualan_id' => 'required'
        ]);
        $pengirimen = Pengiriman::where('id_pengiriman',$req->id_pengiriman)->update($validate);
        if($pengirimen){
            Session::flash('pesan','Data berhasil diubah');
        }else{
            Session::flash('pesan','Data gagal diubah');
        }
        return redirect('/pengiriman');
    }
}
