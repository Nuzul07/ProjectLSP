@extends ('layouts.parent')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Transactions Process</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Transactions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-primary">
                <form method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Pilih Makanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pilih Order</label>
                            <select id="produkSelect" class="form-control select2" name="order_id" required>
                                <option value="">&mdash;</option>
                                @foreach($order as $o)
                                <option value="{{ $o->id }}">Meja No {{ $o->no_meja }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Makanan</label>
                            <select id="produkSelect" class="form-control select2" name="food_id" required>
                                <option value="">&mdash;</option>
                                @foreach($food as $f)
                                <option value="{{ $f->id }}">{{ $f->nama }} Rp{{ $f->harga }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <div class="row">
                            <div class="col-11">
                                <input type="number" class="form-control" value="1" name="jumlah" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="submit-btn">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                    <h4>Keranjang</h4>
                    @if($totalcart != 0)
                    <a class="btn btn-warning btn-sm" href="{{ route('transaksiClean') }}">Bersihkan Keranjang</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Makanan</th>
                                <th>No Meja</th>
                                <th>Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->food->nama }}</td>
                                <td>{{ $t->order->no_meja }}</td>
                                <td>{{ $t->jumlah }}</td>
                                <td>
                                    <a href="#" data-uri="{{ route('transaksi.destroy', $t->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDestroy"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-right">
                        <p class="h5">Total Harga : <b>IDR {{ number_format($totalcart,2,',','.') }}</b></p>
                    </div>
                    <hr>
                </div>
                <div class="card-footer text-right">
                    @if($totalcart != 0)
                    <a href="{{ route('checkout.index') }}" class="btn btn-flat btn-icon icon-left btn-primary"><i class="fas fa-shopping-cart"></i> Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection