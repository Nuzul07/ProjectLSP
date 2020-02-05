@extends ('layouts.parent')

@section ('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Edit User</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit User</h4>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="alamat" value="{{ $user->alamat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Level</label>
                                            <select class="custom-select mr-sm-2" name="level_id" id="inlineFormCustomSelect">
                                                <option selected>{{ $user->level->name }}</option>
                                                @foreach ($level as $l)
                                                <option value="{{ $l->id }}">{{ $l->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password" placeholder="Jika tidak ingin mengubah password kosongkan saja">
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <img src="{{asset('images/'.$user->foto)}}" id="blah1" style="width: 200px;height: 200px;">
                                </center>
                                <br>
                                <center>
                                    <div class="col-sm-4 col-md-3">
                                        <input type="file" class="form-control-file" name="foto" id="exampleInputFile" onchange="readURL1(this);">
                                    </div>
                                </center>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection