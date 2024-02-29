<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //
    public function index(){
        $data['users'] = User::all();
        return view('admin.pengguna',$data);
    }

    public function add(){
        return view('admin.addPengguna');
    }

    public function delete(Request $req){
        $user = User::where('id_pengguna',$req->id_pengguna)->delete();
        
        if($user){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan','Data gagal dihapus');
        }

        return redirect('/pengguna');
    }

    // public function create(Request $req){
    //     $validateData = $req->validate([
    //         'username' => 'required',
    //         'password' => ['required', Password::min(6)->symbols()->mixedCase()],
    //         'level_akses' == 'pelanggan'
    //     ]);
    //     $akun = User::create($validateData);
        
    //     if(!empty($akun)){
    //         $validate = $req->validate([
    //             'nama_pelanggan' => 'required',
    //             'alamat' => 'required',
    //         ]);
    //     }
    // }
}
