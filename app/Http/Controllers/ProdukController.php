<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    //
    public function index(){
        $data['kategori'] = Kategori::all();
        $data['produk'] = Produk::all();
        $data['diskon'] = Diskon::all();
        return view('admin.produk',$data);
    }

    public function create(Request $req){
        $produk = Produk::latest()->first();
        $kode_produk = "PRD";
        if($produk == null){
            $no_kode = '0001';
        }else{
            $explode = explode("-", $produk->kode_produk);
            $no_kode = isset($explode[1]) ? intval($explode[1]) + 1 : 1;
            $no_kode = str_pad($no_kode, 4, '0', STR_PAD_LEFT);
        }
        $kode = $kode_produk."-".$no_kode;
        $req->validate([
            'nama_produk' => 'required',
            'kategori_produk_id' => 'required',
            'gambar_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'tanggal_kadaluarsa' => 'required'
        ]);

        $file = $req->file('gambar_produk');
        $path = $file->storeAs('public/gambar_produk',$file->hashName());

        $produk = Produk::create([
            'kode_produk' => $kode,
            'nama_produk' => $req->nama_produk,
            'kategori_produk_id' => $req->kategori_produk_id,
            'gambar_produk' => $path,
            'harga' => $req->harga,
            'stok' => $req->stok,
            'tanggal_kadaluarsa' => $req->tanggal_kadaluarsa
        ]);

        if($produk){
            // Alert::success('Berhasil','Data berhasil ditambahkan');
            Session::flash('pesan','Data berhasil ditambahkan');
        }else{
            // Session::flash('pesan','Data gagal ditambahkan');
        }

        return redirect('/produk');
    }

    public function updatee(Request $req){
        $req->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'tanggal_kadaluarsa' => 'required'
        ]);

        if($req->hasFile('gambar_produk')){
            $file = $req->file('gambar_produk');
            $path = $file->storeAs('public/gambar_produk',$file->hashName());
        }
    }

    public function update(Request $req){
        // try{
            $req->validate([
                'diskon_produk_id' => 'required'
            ]);
    
            $affectedRow = Produk::where('kode_produk',$req->kode_produk)->update([
                'diskon_produk_id' => $req->diskon_produk_id
            ]);
    
            if($affectedRow > 0){
                $produk = Produk::where('kode_produk',$req->kode_produk)->first();
                if($produk->diskon){
                    if($produk->diskon->jenis_diskon == 'Persentase'){
                        $produk->harga = $produk->harga - ($produk->harga * $produk->diskon->nilai_diskon / 100);
                    }elseif ($produk->diskon->jenis_diskon == 'Nominal'){
                        $produk->harga = $produk->harga - $produk->diskon->nilai_diskon;
                    }
    
                    $produk->save();
                }
                if($produk){
                    Session::flash('pesan','Data berhasil diubah');
                }else{
                    Session::flash('pesan','Data gagal diubah');
                }
            }
        // }catch(\Exception $e){
        //     dd($e->getMessage());
        // }
        return redirect('/produk');
    }

    public function delete(Request $req){
        $produk = Produk::where('kode_produk',$req->kode_produk)->delete();

        if($produk){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan','Data gagal dihapus');
        }

        return redirect('/produk');
    }
}
