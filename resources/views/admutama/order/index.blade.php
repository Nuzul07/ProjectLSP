@extends ('layouts.parent')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Orderss</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include("layouts.components.alertSession")

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Data</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Barcode</th>
                                        <th>User Id</th>
                                        <th>Food Id</th>
                                        <th>No Meja</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(
                                                    $f->barcode, 'C39')}}" height="20" width="100">
                                                <span class="text-barcode">{{ $f->barcode }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $o->user->id }}</td>
                                        <td>{{ $o->food->id }}</td>
                                        <td>{{ $o->no_meja }}</td>
                                        <td>{!! $o->keterangan !!}</td>
                                        @if ($f->status == 1)
                                        <td><span class="badge badge-pill badge-success">Finished</span></td>
                                        @elseif ($0->status == 0)
                                        <td><span class="badge badge-pill badge-danger">Not Finished</span></td>
                                        @endif
                                        <td style="text-align:center"><a href="{{ route('order.edit', $f->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" data-uri="{{ route('order.destroy', $f->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDestroy"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('order.create') }}" class="btn btn-rounded btn-primary" style="color:#fff">Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection