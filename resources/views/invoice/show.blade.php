@extends ('layouts.parent')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Checkout</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Checkouts</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body collapse show">
                        <h4 class="card-title">Transaksi Penjualan &mdash; Checkout</h4>
                        <div class="col-md-6">
                            <address>
                                <strong>Kasir :</strong>
                                {{ Auth::user()->name }}
                            </address>
                        </div>
                        <div class="col-md-12 text-md-right">
                            <address>
                                <strong>Tanggal:</strong><br>
                                @include('____FUNCTION.tglIndo')
                                {{ hari_ini(date("D")) }}, {{ tgl_indo(date("Y-m-d")) }}<br><br>
                            </address>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">Ringkasan Pembelian</div>
                                <p class="section-lead">Semua barang yang dibeli tidak dapat dihapus di sini.</p>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Makanan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th colspan="2">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transaksi as $t)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $t->food->nama }}</td>
                                                <td>IDR {{ number_format($t->food->harga,2,',','.') }}</td>
                                                <td>{{ $t->jumlah }}</td>
                                                <td>IDR {{ number_format($t->total_bayar,2,',','.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-8">
                                    <div class="section-title">Metode Pembayaran</div>
                                    <p class="section-lead">Metode pembayaran yang kami sediakan adalah untuk memudahkan Anda membayar faktur.</p>
                                    <div class="images">
                                        <img class="metode_pembayaran_img" src="{{ asset('Adminmart-lite-master/src/assets/images/cash.png') }}" style="width:10%; heigth:10%;" alt="cash">
                                    </div>
                                    <br>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">IDR {{ number_format($totalcart,2,',','.') }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Bayar</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">IDR {{ number_format($checkouts->bayar,2,',','.') }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Kembalian</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">IDR {{ number_format($checkouts->kembalian,2,',','.') }}</div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <hr>
                                <div class="text-md-right">
                                    <button onclick="window.print()" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection