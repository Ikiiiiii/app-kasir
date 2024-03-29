@extends('partials.tDetail')

@section('content')
<div class="doc-container">
    
    <div class="row">

        <div class="col-xl-9">

            <div class="invoice-container">
                <div class="invoice-inbox">
                    
                    <div id="ct" class="">
                        
                        <div class="invoice-00001">
                            <div class="content-section">

                                <div class="inv--head-section inv--detail-section">
                                
                                    <div class="row">

                                        <div class="col-sm-6 col-12 mr-auto">
                                            <div class="d-flex">
                                                <img class="company-logo" src="{{ asset('/src/assets/img/equation-logo.png') }}" alt="company">
                                                <h3 class="in-heading align-self-center">Equation Inc.</h3>
                                            </div>
                                            <p class="inv-street-addr mt-3">XYZ Delta Street</p>
                                            <p class="inv-email-address">info@company.com</p>
                                            <p class="inv-email-address">(120) 456 789</p>
                                        </div>
                                        
                                        <div class="col-sm-6 text-sm-end">
                                            <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span class="inv-title">Kode Transaksi : </span> <span class="inv-number">#{{ $detailjual->penjualan->kode_transaksi }}</span></p>
                                            <p class="inv-created-date mt-sm-5 mt-3"><span class="inv-title">Tanggal : </span> <span class="inv-date">20 Mar 2022</span></p>
                                            <p class="inv-due-date"><span class="inv-title">Jatuh Tempo : </span> <span class="inv-date">26 Mar 2022</span></p>
                                        </div>                                                                
                                    </div>
                                    
                                </div>

                                <div class="inv--detail-section inv--customer-detail-section">

                                    <div class="row">

                                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                            <p class="inv-to">Invoice Untuk</p>
                                        </div>

                                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                            <h6 class=" inv-title">Invoice Dari</h6>
                                        </div>
                                        
                                        <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                            <p class="inv-customer-name">{{ $pelanggan->nama_pelanggan }}</p>
                                            <p class="inv-street-addr">{{ $pelanggan->alamat }}</p>
                                            <p class="inv-email-address">{{ $pengguna->email }}</p>
                                            <p class="inv-email-address">{{ $pelanggan->no_telepon }}</p>
                                        </div>
                                        
                                        <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                            <p class="inv-customer-name">Rizky Akbar</p>
                                            <p class="inv-street-addr">2161 Ferrell Street, MN, 56545 </p>
                                            <p class="inv-email-address">rizky@gmail.com</p>
                                            <p class="inv-email-address">0812-3214-0921</p>
                                        </div>

                                    </div>
                                    
                                </div>

                                <div class="inv--product-table-section">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Produk</th>
                                                    <th class="text-end" scope="col">Jumlah</th>
                                                    <th class="text-end" scope="col">Harga</th>
                                                    <th class="text-end" scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $detailjual->id_detail_jual }}</td>
                                                    <td>{{ $detailjual->produk->nama_produk }}</td>
                                                    <td class="text-end">{{ $detailjual->jumlah_produk }}</td>
                                                    <td class="text-end">{{ number_format($detailjual->harga_jual, '0', ',', '.') }}</td>
                                                    <td class="text-end">{{ number_format($subtotal, '0', ',', '.') }}</td>
                                                </tr>
                                                {{-- <tr>
                                                    <td>2</td>
                                                    <td>Chat App Customization</td>
                                                    <td class="text-end">1</td>
                                                    <td class="text-end">$230</td>
                                                    <td class="text-end">$230</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Laravel Integration</td>
                                                    <td class="text-end">1</td>
                                                    <td class="text-end">$405</td>
                                                    <td class="text-end">$405</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Backend UI Design</td>
                                                    <td class="text-end">1</td>
                                                    <td class="text-end">$2500</td>
                                                    <td class="text-end">$2500</td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="inv--total-amounts">
                                
                                    <div class="row mt-4">
                                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                                        </div>
                                        <div class="col-sm-7 col-12 order-sm-1 order-0">
                                            <div class="text-sm-end">
                                                <div class="row">
                                                    <div class="col-sm-8 col-7">
                                                        <p class="">Sub Total :</p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">{{ number_format($subtotal, '0', ',', '.') }}</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7">
                                                        <p class=" discount-rate">Shipping :</p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">$10</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7">
                                                        <p class=" discount-rate">Discount 5% :</p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="">$150</p>
                                                    </div>
                                                    <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                        <h4 class="">Grand Total : </h4>
                                                    </div>
                                                    <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                        <h4 class="">$3480</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="inv--note">

                                    <div class="row mt-4">
                                        <div class="col-sm-12 col-12 order-sm-0 order-1">
                                            <p>Note: Senang Berbisnis dengan anda.</p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div> 
                        
                    </div>


                </div>

            </div>

        </div>

        <div class="col-xl-3">

            <div class="invoice-actions-btn">

                <div class="invoice-action-btn">

                    <div class="row">
                        <div class="col-xl-12 col-md-3 col-sm-6">
                            <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                        </div>
                        <div class="col-xl-12 col-md-3 col-sm-6">
                            <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                        </div>
                        <div class="col-xl-12 col-md-3 col-sm-6">
                            <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                        </div>
                    </div>

                </div>
                
            </div>
            
        </div>

    </div>
    
</div>
@endsection