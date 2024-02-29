@extends('partials.tPenjualan')

@section('content')
    <h1>Data Penjualan</h1>
    <p class="text-secondary">
        @if (Session::get('pesan'))
            {{ Session::get('pesan') }}
        @endif
    </p>
    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="d-grid gap-2 d-md-flex justify-content-end">
                {{-- <a href="/kategori/add" class="btn btn-sm btn-primary mb-2">Tambah</a> --}}
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm mb-2 btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Tambah Data Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="/penjualan/create" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="" class="text-white">Kode Transaksi</label>
                                    <input type="text" name="kode_transaksi" id="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-2">
                                    <label class="text-white" for="">Nama Produk</label>
                                    <select name="produk_kode" id="" class="form-select">
                                        <option value="" selected>Pilih Produk -</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <label for="" class="text-white">Nama Pelanggan</label>
                                    <select name="pelanggan_id" id="" class="form-select">
                                        <option value="" selected>Pilih Pelanggan -</option>
                                        @foreach ($pelanggan as $item)
                                            <option value="{{ $item->id_pelanggan }}">{{ $item->nama_pelanggan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-2">
                                    <label for="" class="text-white">Harga Jual</label>
                                    <input type="number" name="harga_jual" class="form-control">
                                </div>
                                <div class="col-sm-6 mt-2">
                                    <label for="" class="text-white">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah_produk" id="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
                                    <label for="" class="text-white">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" class="form-select" id="">
                                        <option value="" selected>Pilih metode pembayaran -</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="COD">COD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <table id="style-3" class="table style-3 dt-table-hover">
                        <thead>
                            <tr>
                                <th class="">Kode Transaksi</th>
                                <th class="">Nama Produk</th>
                                <th class="">Nama Pelanggan</th>
                                <th class="">Harga Jual</th>
                                <th class="">Jumlah</th>
                                <th class="">Metode Pembayaran</th>
                                <th class="">Tanggal Jual</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                            <tr>
                                <td class="">{{ $item->penjualan->kode_transaksi }}</td>
                                <td class="">{{ $item->produk->nama_produk }}</td>
                                <td class="">{{ $item->penjualan->pelanggan->nama_pelanggan }}</td>
                                <td class="">Rp{{ number_format($item->harga_jual, '0', ',', '.') }}</td>
                                <td class="">{{ $item->jumlah_produk }}</td>
                                <td class="">{{ $item->penjualan->metode_pembayaran }}</td>
                                <td class="">{{ Carbon\Carbon::parse($item->penjualan->tanggal_jual)->format('d-m-Y')  }}</td>
                                <td class="text-center">
                                    <ul class="table-controls">
                                        <li><a href="/penjualan/detail/{{ $item->penjualan->id_penjualan }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail" data-original-title="Detail"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-2 p-1 br-8 mb-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><path d="M15 12 A3 3 0 0 1 12 15 A3 3 0 0 1 9 12 A3 3 0 0 1 15 12 z"/></svg></a></li>
                                        <li><a href="/pelanggan/edit/" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                        <li><a href="/penjualan/delete/{{ $item->penjualan->id_penjualan }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                    </ul>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection