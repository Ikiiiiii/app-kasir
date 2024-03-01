@extends('partials.tUsers')

@section('content')
<h1>Data Pengguna</h1>

<p class="text-secondary">
    @if (Session::get('pesan'))
        {{ Session::get('pesan') }} 
    @endif
</p>

<div class="row layout-spacing">
<div class="col-lg-12 mt-2">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <table id="style-3" class="table style-3 dt-table-hover">
                <thead>
                    <tr>
                        <th class="checkbox-column text-center">Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th class="text-center">Level Akses</th>
                        <th class="text-center dt-no-sorting">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $key => $item)
                    @if($item->level_akses != 'admin')
                    <tr>
                        <td class="checkbox-column text-center">{{ $key+1 }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">
                            <span class="shadow-none badge 
                            @if($item->level_akses == 'petugas') badge-success
                            @elseif($item->level_akses == 'pelanggan') badge-warning
                            @endif">{{ $item->level_akses }}</span>
                        </td>
                        <td class="text-center">
                            <ul class="table-controls">
                                <li><a href="/pengguna/edit/{{ $item->id_pengguna }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                <li><a href="/pengguna/delete/{{ $item->id_pengguna }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                            </ul>
                        </td>   
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection