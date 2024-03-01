<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diskon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class DiskonController extends Controller
{
    //
    public function index(){
        $data['diskon'] = Diskon::all();
        $data['jenis'] = ['Persentase','Nominal'];
        return view('admin.diskon',$data);
    }

    public function create(Request $req){
        $validate = $req->validate([
            'nama_diskon' => 'required',
            'jenis_diskon' => 'required',
            'nilai_diskon' => ['required','numeric'],
            'deskripsi' => 'required',
            'berlaku_mulai' => 'required',
            'berlaku_selesai' => 'required'
        ]);
        
        $diskon = Diskon::create($validate);
        if($diskon){
            Session::flash('pesan','Data berhasil ditambahkan');
        }else{
            Session::flash('pesan','Data gagal ditambahkan');
        }
        // try {
            
            // Operasi penyimpanan data
        // } catch (\Exception $e) {
        //     dd($e->getMessage()); // Tampilkan pesan kesalahan
        // }

        return redirect('/diskon');
    }

    public function delete(Request $req){
        $diskon = Diskon::where('id_diskon_produk',$req->id_diskon_produk)->delete();
        
        if($diskon){
            Session::flash('pesan','Data berhasil dihapus');
        }else{
            Session::flash('pesan','Data gagal dihapus');
        }

        return redirect('/diskon');
    }
}
