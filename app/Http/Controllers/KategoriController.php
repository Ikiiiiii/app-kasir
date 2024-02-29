<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    //
    public function index(){
        $data['kategori'] = Kategori::all();
        return view('admin.kategori',$data);
    }

    // public function add(){
    //     return view('admin.addKategori');
    // }

    public function create(Request $req){
        $kategori = Kategori::create([
            'nama_kategori' => $req->nama_kategori
        ]);
        if($kategori){
            Session::flash('pesan','Data berhasil ditambahkan');
        }else{
            Session::flash('pesan','Data gagal ditambahkan');
        }
        return redirect('/kategori');
    }

    public function update(Request $req){
        $validate = $req->validate([
            'nama_kategori' => 'required'
        ]);
        $kategori = Kategori::where('id_kategori_produk',$req->id_kategori_produk)->update($validate);
        if($kategori){
            Session::flash('pesan','Data berhasil diubah');
        }else{
            Session::flash('pesan','Data gagal diubah');
        }
        return redirect('/kategori');
    }

    public function delete(Request $req){
        $kategori = Kategori::where('id_kategori_produk',$req->id_kategori_produk)->delete();
        if($kategori){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan','Data gagal dihapus');
        }
        return redirect('/kategori');
    }
}
