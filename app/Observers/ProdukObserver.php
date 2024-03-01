<?php

namespace App\Observers;

use App\Models\Produk;

use App\Models\DetailJual;

class ProdukObserver
{
    /**
     * Handle the Produk "created" event.
     */
    public function created(Produk $produk): void
    {
        //
    }

    /**
     * Handle the Produk "updated" event.
     */
    public function updated(Produk $produk): void
    {
        // Ambil semua data detail jual yang terkait kode produk ini
        $details = DetailJual::where('produk_kode',$produk->kode_produk)->get();

        // Update harga jual di setiap detail_penjualan
        foreach($details as $detail){
            $hargaJualBaru = $produk->harga - ($produk->diskon_id_produk ? $produk->diskon->nilai_diskon : 0);

            $detail->update([
                'harga_jual' => $hargaJualBaru,
            ]);
        }
    }

    /**
     * Handle the Produk "deleted" event.
     */
    public function deleted(Produk $produk): void
    {
        //
    }

    /**
     * Handle the Produk "restored" event.
     */
    public function restored(Produk $produk): void
    {
        //
    }

    /**
     * Handle the Produk "force deleted" event.
     */
    public function forceDeleted(Produk $produk): void
    {
        //
    }
}
