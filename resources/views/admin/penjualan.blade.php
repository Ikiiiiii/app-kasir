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
                <a href="/export" class="btn btn-sm mb-2 btn-success"><i class="bi bi-filetype-xlsx me-1"></i>Export</a>
                <button type="button" class="btn btn-sm mb-2 btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah
                </button>
                
                <!-- Modal -->
                <div class="modal animated fadeInDown" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Tambah Data Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <form action="/penjualan/create" method="post" enctype="multipart/form-data">
                            @csrf
                            <div id="input-produk" class="produk-input" data-index="0">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="text-white" for="produk_kode">Nama Produk</label>
                                        <select name="produk[0][produk_kode]" class="form-select">
                                            <option value="" selected>Pilih Produk -</option>
                                            @foreach ($produk as $item)
                                                <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="jumlah" class="text-white">Jumlah</label>
                                        <input type="number" class="form-control" name="produk[0][jumlah_produk]" id="" value="1">
                                    </div>
                                    <div class="col-sm-1 mt-2" id="hapus-produk-0" style="display: none;">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusProduk(0)"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-2">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="tambahProduk()">Tambah Produk</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-2">
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
                                    <label for="">Tanggal Jual</label>
                                    <input type="date" name="tanggal_jual" class="form-control" id="">
                                </div>
                                <div class="col-sm-6 mt-2">
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
                        <script>
                            let counter = 1;

                            function tambahProduk() {
                                console.log('Tambah Produk');

                                const inputProduks = document.getElementById('input-produk');
                                const newInputProduk = document.createElement('div');
                                newInputProduk.className = 'row produk-input';
                                newInputProduk.id = `produk-${counter}`;
                                newInputProduk.innerHTML = `
                                <div class="row">
                                    <div class="col-sm-6 mt-2">
                                        <label class="text-white" for="produk_kode">Nama Produk</label>
                                        <select name="produk[${counter}][produk_kode]" class="form-select">
                                            <option value="" selected>Pilih Produk -</option>
                                            @foreach ($produk as $item)
                                                <option value="{{ $item->kode_produk }}">{{ $item->nama_produk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-5 mt-2">
                                        <label for="jumlah" class="text-white">Jumlah</label>
                                        <input type="number" class="form-control" name="produk[${counter}][jumlah_produk]" id="" value="1">
                                    </div>
                                    <div class="col-sm-1 mt-2" id="hapus-produk-${counter}">
                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusProduk(${counter})">Hapus Produk</button>
                                    </div>
                                </div>
                                `;

                                inputProduks.appendChild(newInputProduk);

                                const tombolHapus = document.getElementById(`hapus-produk-${counter}`);
                                if (tombolHapus) {
                                    tombolHapus.style.display = 'inline-block';
                                }

                                counter++;
                            }

                            function hapusProduk(index){
                                const produkInput = document.getElementById('input-produk');
                                const produkToRemove = document.getElementById(`produk-${index}`);

                                if(produkToRemove){
                                    produkInput.removeChild(produkToRemove);
                                } else {
                                    console.error(`Gagal`);
                                }
                            }
                        </script>
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
                                <th class="">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupedDetails as $kodeTransaksi => $details)
                                @php
                                    $subtotal = 0;    
                                @endphp
                    
                                @foreach ($details as $detail)
                                    <tr>
                                        <td class="">{{ $detail->penjualan->kode_transaksi }}</td>
                                        <td class="">{{ $detail->produk->nama_produk }}</td>
                                        <td class="">{{ $detail->penjualan->pelanggan->nama_pelanggan }}</td>
                                        <td class="">Rp{{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $detail->jumlah_produk }}</td>
                                        <td class="">{{ $detail->penjualan->metode_pembayaran }}</td>
                                        <td class="">{{ Carbon\Carbon::parse($detail->penjualan->tanggal_jual)->format('d-m-Y')  }}</td>
                                        <td class="">{{ number_format($detail->jumlah_produk * $detail->produk->harga, 0, ',', '.') }}</td>
                                    </tr> 
                    
                                    {{-- Akumulasi Subtotal --}}
                                    @php
                                        $subtotal += $detail->jumlah_produk * $detail->produk->harga;
                                    @endphp
                                @endforeach
                    
                                <tr>
                                    <td colspan="7" class="fw-bold" style="text-align:right">Grand Total ({{ $kodeTransaksi }}) :</td>
                                    <td>Rp{{ number_format($subtotal, 0, ',', '.')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
@endsection