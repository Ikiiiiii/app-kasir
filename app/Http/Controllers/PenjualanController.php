<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\DetailJual;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    //
    public function index(){
        $data['produk'] = Produk::all();
        $data['pelanggan'] = Pelanggan::all();
        $data['penjualan'] = Penjualan::all();
        $groupedDetails = DetailJual::with('produk', 'penjualan.pelanggan')
        ->get()
        ->groupBy('penjualan.kode_transaksi');
    
        $data['groupedDetails'] = $groupedDetails;

        // Menyiapkan array untuk menyimpan subtotal setiap grup transaksi
        $subtotals = [];

        // Iterasi melalui setiap grup transaksi
        foreach ($groupedDetails as $kodeTransaksi => $details) {
            $subtotal = 0;

            // Iterasi melalui setiap detail transaksi pada grup
            foreach ($details as $detail) {
                $subtotal += $detail->jumlah_produk * $detail->produk->harga;
            }

            // Menyimpan subtotal ke dalam array
            $subtotals[$kodeTransaksi] = $subtotal;
        }

        // Menambahkan data subtotal ke dalam array data
        $data['subtotals'] = $subtotals;
        
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
    $penjualan = Penjualan::latest()->first();
    $kode_transaksi = "TRN";

    if ($penjualan == null) {
        $no_kode = '0001';
    } else {
        $no_kode = isset($penjualan->id_penjualan) ? $penjualan->id_penjualan + 1 : 1;
        $no_kode = str_pad($no_kode, 4, '0', STR_PAD_LEFT);
    }

    $kode = $kode_transaksi . "-" . $no_kode;

    $req->validate([
        'tanggal_jual' => 'required',
        'metode_pembayaran' => 'required',
        'pelanggan_id' => 'required',
        'produk' => 'required|array|min:1',
        'produk.*.produk_kode' => 'required',
        'produk.*.jumlah_produk' => 'required|numeric|min:1',
    ]);

    $penjualan = Penjualan::create([
        'kode_transaksi' => $kode,
        'tanggal_jual' => $req->tanggal_jual,
        'metode_pembayaran' => $req->metode_pembayaran,
        'pelanggan_id' => $req->pelanggan_id,
    ]);

    if (!$penjualan) {
        Session::flash('pesan', 'Gagal membuat data penjualan');
        return redirect()->back();
    }

    foreach ($req->produk as $produk) {
        $product = Produk::where('kode_produk', $produk['produk_kode'])->first();

        if ($produk['jumlah_produk'] > $product->stok) {
            Session::flash('pesan', 'Stok produk ' . $product->nama_produk . ' tidak mencukupi');
            return redirect()->back();
        }

        $detail = DetailJual::create([
            'produk_kode' => $produk['produk_kode'],
            'harga_jual' => $product->harga,
            'jumlah_produk' => $produk['jumlah_produk'],
            'penjualan_id' => $penjualan->id_penjualan,
        ]);

        if (!$detail) {
            Session::flash('pesan', 'Gagal menambahkan detail penjualan');
        }
    }

    Session::flash('pesan', 'Data berhasil ditambahkan');
    return redirect('/penjualan');
}

    public function export()
    {
        $data['produk'] = Produk::all();
        $data['pelanggan'] = Pelanggan::all();
        $data['penjualan'] = Penjualan::all();
        $groupedDetails = DetailJual::with('produk', 'penjualan.pelanggan')
            ->get()
            ->groupBy('penjualan.kode_transaksi');
        
        $data['groupedDetails'] = $groupedDetails;

        // Membuat PDF
        $pdf = PDF::loadView('admin.penjualan-pdf', $data);

        // Mengunduh PDF atau menampilkan di browser
        return $pdf->download('penjualan.pdf');
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
