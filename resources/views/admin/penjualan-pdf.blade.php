<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - PDF</title>
    <style>
        /* Gaya CSS untuk PDF */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Data Penjualan</h1>

    @foreach ($groupedDetails as $kodeTransaksi => $details)
        @php
            $subtotal = 0;    
        @endphp

        <table>
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Produk</th>
                    <th>Nama Pelanggan</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>Metode Pembayaran</th>
                    <th>Tanggal Jual</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->penjualan->kode_transaksi }}</td>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->penjualan->pelanggan->nama_pelanggan }}</td>
                        <td>Rp{{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $detail->jumlah_produk }}</td>
                        <td>{{ $detail->penjualan->metode_pembayaran }}</td>
                        <td>{{ Carbon\Carbon::parse($detail->penjualan->tanggal_jual)->format('d-m-Y')  }}</td>
                        <td>{{ number_format($detail->jumlah_produk * $detail->produk->harga, 0, ',', '.') }}</td>
                    </tr> 

                    {{-- Akumulasi Subtotal --}}
                    @php
                        $subtotal += $detail->jumlah_produk * $detail->produk->harga;
                    @endphp
                @endforeach

                <tr>
                    <td colspan="7" class="fw-bold" style="text-align:right">Grand Total ({{ $kodeTransaksi }}) :</td>
                    <td>{{ number_format($subtotal, 0, ',', '.')}}</td>
                </tr>
            </tbody>
        </table>
    @endforeach

</body>
</html>
