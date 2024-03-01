@extends('partials.tPelanggan')

@section('content')
<h1>Data Pelanggan</h1>
{{-- <p class="text-secondary">
    @if (Session::get('pesan'))
        {{ Session::get('pesan') }}
    @endif
</p> --}}
<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            {{-- <a href="pelanggan/add" class="btn btn-sm btn-primary mb-2">Tambah</a> --}}
            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#fadeinModal">Tambah</button>
            <div id="fadeinModal" class="modal animated fadeInDown" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Input Data Pelanggan & Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button>
                        </div>
                        <div class="modal-body">
                              <form action="pelanggan/create" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5>Input Data Akun</h5>
                                        <label for="">Username</label>
                                        <input type="text" name="username" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <label for="">Email</label>
                                        <input type="email" name="email" id="" class="form-control">
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <label for="">Password</label>
                                        <input type="password" name="password" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-4">
                                        <h5>Input Data Pelanggan</h5>
                                        <label for="">Nama Pelanggan</label>
                                        <input type="text" name="nama_pelanggan" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <label for="">Alamat</label>
                                        <textarea class="form-control" name="alamat" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mt-2">
                                        <label for="">No Telepon</label>
                                        <input type="text" name="no_telepon" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Discard</button>
                                <input type="submit" class="btn btn-primary" value="Save">
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
                            <th class="checkbox-column text-center">Id Pelanggan</th>
                            <th class="">Nama</th>
                            <th class="">Alamat</th>
                            <th class="">No Telepon</th>
                            <th class="text-center">Username</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($pelanggan as $item)
                        <tr>
                            <td class="checkbox-column text-center">{{ $loop->iteration }}</td>
                            <td class="">{{ $item->nama_pelanggan }}</td>
                            <td class="">{{ $item->alamat }}</td>
                            <td class="">{{ $item->no_telepon }}</td>
                            <td class="text-center">
                                <span class="shadow-none badge badge-primary">{{ $item->user->username }}</span>
                            </td>
                            <td class="text-center">
                                <ul class="table-controls">
                                    <li><a href="" class="bs-tooltip" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id_pelanggan }}" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                    <div class="modal animated fadeInDown" id="edit{{ $item->id_pelanggan }}" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content text-start">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data Pelanggan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                      <form action="pelanggan/update/{{ $item->id_pelanggan }}" method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="">Nama Pelanggan</label>
                                                                <input type="text" name="nama_pelanggan" id="" value="{{ $item->nama_pelanggan }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 mt-2">
                                                                <label for="">Alamat</label>
                                                                <textarea class="form-control" name="alamat" id="" cols="30" rows="5">{{ $item->alamat }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12 mt-2">
                                                                <label for="">No Telepon</label>
                                                                <input type="text" name="no_telepon" value="{{ $item->no_telepon }}" id="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-dark" data-bs-dismiss="modal">Discard</button>
                                                        <input type="submit" class="btn btn-primary" value="Save">
                                                    </form>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <li><a href="#" data-id="{{ $item->id_pelanggan }}" data-nama="{{ $item->nama_pelanggan }}" class="bs-tooltip delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                </ul>
                            </td>   
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection