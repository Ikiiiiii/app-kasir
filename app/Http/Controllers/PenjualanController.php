<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailJual;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    //
    public function index(){
        $data['produk'] = Produk::all();
        $data['pelanggan'] = Pelanggan::all();
        $data['detail'] = DetailJual::all();
        $data['penjualan'] = Penjualan::all();
        
        return view('admin.penjualan',$data);
    }

    public function detail($id_detail_jual){
        $detailjual = DetailJual::find($id_detail_jual);

        $pelanggan = $detailjual->penjualan->pelanggan;

        $pengguna = $detailjual->penjualan->pelanggan->user;

        $harga_jual = $detailjual->harga_jual;
        $jumlah_produk = $detailjual->jumlah_produk;

        $subtotal = $harga_jual * $jumlah_produk;

        return view('admin.detailJual', [
            'detailjual' => $detailjual,
            'pelanggan' => $pelanggan,
            'pengguna' => $pengguna,
            'subtotal' => $subtotal
        ]);
    }

    public function create(Request $req){
        $req->validate([
            'kode_transaksi' => 'required',
            'produk_kode' => 'required',
            'harga_jual' => 'required',
            'jumlah_produk' => 'required',
            'metode_pembayaran' => 'required',
            'pelanggan_id' => 'required'
        ]);

        $penjualan = Penjualan::create([
            'kode_transaksi' => $req->kode_transaksi,
            'metode_pembayaran' => $req->metode_pembayaran,
            'pelanggan_id' => $req->pelanggan_id
        ]);

        if($penjualan){
            $detail = DetailJual::create([
                'produk_kode' => $req->produk_kode,
                'harga_jual' => $req->harga_jual,
                'jumlah_produk' => $req->jumlah_produk,
                'penjualan_id' => $penjualan->id_penjualan,
            ]);
            if($detail){
                Session::flash('pesan','Data berhasil ditambahkan');
                return redirect('/penjualan');
            }else{
                Session::flash('pesan','Data gagal ditambahkan');
                return redirect()->back();
            }
        }
    }

    public function delete(Request $req){
        DetailJual::where('penjualan_id',$req->id_penjualan)->delete();
        $penjualan = Penjualan::where('id_penjualan',$req->id_penjualan)->delete();
        if($penjualan){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan', 'Data gagal dihapus');
        }
        return redirect('penjualan');
    }

}
