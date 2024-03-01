<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class PelangganController extends Controller
{
    //
    public function index(){
        $data['pelanggan'] = Pelanggan::all();
        return view('admin.pelanggan',$data);
    }

    public function add(){
        return view('admin.addPelanggan');
    }

    public function create(Request $req){
        $req->validate([
            'username' => 'required',
            'email' => ['required','email'],
            'password' => ['required','min:6'],
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        $akun = User::create([
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password,
            'level_akses' => 'pelanggan'
        ]);

        if(!empty($akun)){
            $pelanggan = Pelanggan::create([
                'nama_pelanggan' => $req->nama_pelanggan,
                'alamat' => $req->alamat,
                'no_telepon' => $req->no_telepon,
                'pengguna_id' => $akun->id_pengguna
            ]);

            if($pelanggan){
                Session::flash('pesan','Data berhasil ditambahkan');
                return redirect('/pelanggan');
            }else{
                Session::flash('pesan','Data gagal ditambahkan');
                return redirect()->back();
            }
        }
    }

    public function update(Request $req){
        $validate = $req->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);
        $pelanggan = Pelanggan::where('id_pelanggan',$req->id_pelanggan)->update($validate);
        if($pelanggan){
            Session::flash('pesan','Data berhasil diedit');
        }else{
            Session::flash('pesan','Data gagal diedit');
        }
        return redirect('/pelanggan');
    }

    public function delete(Request $req){
        $pelanggan = Pelanggan::where('id_pelanggan',$req->id_pelanggan)->delete();
        if($pelanggan){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan','Data gagal dihapus');
        }
        return redirect('/pelanggan');
    }
}
