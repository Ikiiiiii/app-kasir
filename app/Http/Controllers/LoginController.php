<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function auth(Request $req){
        $credentials = $req->validate([
            'akun' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email'=>$req->akun,'password'=>$req->password])){
            return redirect('dashboard');
        }elseif(Auth::attempt(['username'=>$req->akun,'password'=>$req->password])){
            return redirect('dashboard');
        }
        return redirect()->back();

    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
