@extends('partials.tUsers')

@section('content')
<table>
        <form action="create" method="POST">
            <tr>
                <td>
                    <h4>Input Data Akun</h4>
                    <label for="">Username</label>
                    <input class="form-control" type="text" name="username" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Password</label>
                    <input class="form-control" type="password" name="password" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <h4 class="mt-3">Input Data Pelanggan</h4>
                    <label for="">Nama Pelanggan</label>
                    <input type="text" class="form-control" name="nama_pelanggan" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Alamat</label>
                    <textarea class="form-control" name="alamat" id="" cols="30" rows="5"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">No Telepon</label>
                    <input class="form-control" type="text" name="no_telepon" id="">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="mt-2 btn btn-outline-success" value="Submit">
                </td>
            </tr>
        </form>
    </table>
@endsection