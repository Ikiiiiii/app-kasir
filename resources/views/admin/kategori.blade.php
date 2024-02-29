@extends('partials.tKategori')

@section('content')
    <h1>Data Kategori</h1>

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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Data Kategori</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="/kategori/create" method="post">
                            @csrf
                            <label class="" for="">Input Nama Kategori</label>
                            <input class="form-control" type="text" name="nama_kategori" id="">
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
                                <th class="checkbox-column text-center">Id</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $item)
                            <tr>
                                <td class="checkbox-column text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nama_kategori }}</td>
                                <td class="text-center">
                                    <ul class="table-controls">
                                        <li><a href=""  class="bs-tooltip" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id_kategori_produk }}" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                        <div class="modal animated fadeInDown" id="edit{{ $item->id_kategori_produk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Data Kategori</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="/kategori/update/{{ $item->id_kategori_produk }}" method="post">
                                                    @csrf
                                                    <label class="" for="">Input Nama Kategori</label>
                                                    <input class="form-control" type="text" name="nama_kategori" value="{{ $item->nama_kategori }}" id="">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <li><a href="/kategori/delete/{{ $item->id_kategori_produk }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
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