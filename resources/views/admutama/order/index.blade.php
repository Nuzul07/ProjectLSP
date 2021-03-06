@extends ('layouts.parent')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Orders</h4>
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
                            <table id="zero_config" class="table table-striped table-bordered no-wrap text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>Food Id</th>
                                        <th>No Meja</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order as $o)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $o->user->id }}</td>
                                        <td>{{ $o->food->id }}</td>
                                        <td>{{ $o->no_meja }}</td>
                                        <td>{!! $o->keterangan !!}</td>
                                        @if ($o->status == 1)
                                        <td><span class="badge badge-pill badge-success">Finished</span></td>
                                        @elseif ($o->status == 0)
                                        <td><span class="badge badge-pill badge-danger">Not Finished</span></td>
                                        @endif
                                        <td><a href="#" data-uri="{{ route('order.destroy', $o->id) }}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDestroy"><i class="fas fa-trash-alt"></i></a></td>
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