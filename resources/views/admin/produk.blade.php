@extends('partials.tProduk')

@section('content')
<h1>Data Produk</h1>
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
            <div class="modal animated fadeInDown" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="/produk/create" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="" for="">Kode Produk</label>
                                <input class="form-control" type="text" name="kode_produk" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <label for="" class="">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="" class="">Kategori</label>
                                <select class="form-select" name="kategori_produk_id" id="">
                                    <option selected>Pilih Kategori -</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id_kategori_produk }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <label for="" class="">Foto Produk</label>
                                <input type="file" name="gambar_produk" class="form-control file-upload-input">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <label for="" class="">Harga</label>
                                <input type="text" name="harga" class="form-control">
                            </div>
                            <div class="col-sm-6 mt-2">
                                <label for="" class="">Stok</label>
                                <input type="text" name="stok" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 mt-2">
                                <label for="" class="">Tanggal Kadaluarsa</label>
                                <input type="date" class="form-control" name="tanggal_kadaluarsa" id="">
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
                            <th class="checkbox-column text-center">Kode Produk</th>
                            <th class="">Produk</th>
                            <th>Kategori</th>
                            @if (Auth::user()->level_akses == 'petugas')
                                <th>Diskon</th>
                            @endif
                            <th class="text-center">Harga</th>
                            <th class="text-center">Stok</th>
                            <th>Kadaluarsa</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($produk as $item)
                        <tr>
                            <td class="checkbox-column text-center">{{ $item->kode_produk }}</td>
                            <td class="">
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="avatar me-3">
                                        <img src="{{ asset('storage/'. $item->gambar_produk) }}" width="64" height="64" alt="">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="text-truncate fw-bold">{{ $item->nama_produk }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="">{{ $item->kategori->nama_kategori }}</td>
                            @if (Auth::user()->level_akses == 'petugas')
                                <td>
                                    @if (isset($item->diskon))
                                        @if ($item->diskon->jenis_diskon == 'Persentase')
                                            {{ $item->diskon->nilai_diskon }}%
                                        @else
                                            Rp{{ number_format($item->diskon->nilai_diskon, 0, ',', '.') }}
                                        @endif
                                    @else
                                        0
                                    @endif
                                </td>
                            @endif
                            <td class="text-center">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="shadow-none badge badge-primary rounded-pill">{{ $item->stok }}</span>
                            </td>
                            <td>{{Carbon\Carbon::parse($item->tanggal_kadaluarsa)->format('d-m-Y')}}</td>
                            <td class="">
                                <ul class="table-controls">
                                    <li><a href="" class="bs-tooltip text-center" data-bs-toggle="modal" data-bs-target="#edit{{ $item->kode_produk }}" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                    <div class="modal animated fadeInDown" id="edit{{ $item->kode_produk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 " id="staticBackdropLabel">Edit Data Produk</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="/produk/update/{{ $item->kode_produk }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label class="" for="">Kode Produk</label>
                                                        <input class="form-control" type="text" name="kode_produk" id="" readonly value="{{ $item->kode_produk }}">
                                                    </div>
                                                </div>
                                                @if(Auth::user()->level_akses == 'petugas')
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <label for="" class="">Nama Produk</label>
                                                        <input disabled type="text" name="nama_produk" class="form-control" value="{{ $item->nama_produk }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Kategori</label>
                                                        <select disabled class="form-select" name="kategori_produk_id" id="">
                                                            <option selected>Pilih Kategori -</option>
                                                            @foreach ($kategori as $kategorii)
                                                                <option selected value="{{ $kategorii->id_kategori_produk }}">{{ $kategorii->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Diskon</label>
                                                        <select name="diskon_produk_id" id="" class="form-select">
                                                            <option value="">Pilih Diskon</option>
                                                            @foreach ($diskon as $discount)
                                                                <option value="{{ $discount->id_diskon_produk }}">{{ $discount->nama_diskon }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <label for="" class="">Foto Produk</label>
                                                        @if(file_exists("storage/".$item->gambar_produk))
                                                        <img src="/storage/{{ $item->gambar_produk }}" width="50" height="50" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Harga</label>
                                                        <input disabled type="text" name="harga" class="form-control" value="{{ $item->harga }}">
                                                    </div>
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Stok</label>
                                                        <input disabled type="text" name="stok" class="form-control" value="{{ $item->stok }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <label for="" class="">Tanggal Kadaluarsa</label>
                                                        <input disabled type="date" class="form-control" name="tanggal_kadaluarsa" id="" value="{{ $item->tanggal_kadaluarsa }}">
                                                    </div>
                                                </div>
                                                @else
                                                <div class="row">
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Nama Produk</label>
                                                        <input type="text" name="nama_produk" class="form-control" value="{{ $item->nama_produk }}">
                                                    </div>
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Kategori</label>
                                                        <select class="form-select" name="kategori_produk_id" id="">
                                                            <option selected>Pilih Kategori -</option>
                                                            @foreach ($kategori as $kategorii)
                                                                <option selected value="{{ $kategorii->id_kategori_produk }}">{{ $kategorii->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <label for="" class="">Foto Produk</label>
                                                        @if(file_exists("storage/".$item->gambar_produk))
                                                        <img src="/storage/{{ $item->gambar_produk }}" width="50" height="50" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Harga</label>
                                                        <input type="text" name="harga" class="form-control" value="{{ $item->harga }}">
                                                    </div>
                                                    <div class="col-sm-6 mt-2">
                                                        <label for="" class="">Stok</label>
                                                        <input type="text" name="stok" class="form-control" value="{{ $item->stok }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 mt-2">
                                                        <label for="" class="">Tanggal Kadaluarsa</label>
                                                        <input type="date" class="form-control" name="tanggal_kadaluarsa" id="" value="{{ $item->tanggal_kadaluarsa }}">
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <li><a href="/produk/delete/{{ $item->kode_produk }}" class="bs-tooltip text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
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