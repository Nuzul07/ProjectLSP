@extends ('layouts.parent')
@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Users</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Data</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Level</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $u)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('images/'.$u->foto) }}" alt="foto" width="30" height="30" data-toggle="tooltip" data-original-title="{{ $u->name }}" style="object-fit: cover;border-radius: 50%;border: 1px solid #6777ef;">
                                        </td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->alamat }}</td>
                                        <td><span class="badge badge-pill badge-primary">{{ $u->level->name }}</span></td>
                                        <td style="text-align:center"><a href="{{ route('users.edit', $u->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="{{ url('users/destroy', $u->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('users.create') }}" class="btn btn-rounded btn-primary" style="color:#fff">Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection