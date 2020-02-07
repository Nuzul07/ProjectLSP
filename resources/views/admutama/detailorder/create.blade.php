@extends ('layouts.parent')

@section ('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Create Detail Order</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detail Order</li>
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
                        <h4 class="card-title">Form Detail Order</h4>
                        <form action="{{ route('orderdetail.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Select Order</label>
                                            <select class="custom-select mr-sm-2" name="order_id" id="inlineFormCustomSelect">
                                                <option selected>Choose...</option>
                                                @foreach ($order as $o)
                                                <option value="{{ $o->id }}">Meja Nomor {{ $o->no_meja }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label class="mr-sm-2" for="inlineFormCustomSelect">Select Food</label>
                                            <select class="custom-select mr-sm-2" name="food_id" id="inlineFormCustomSelect">
                                                <option selected>Choose...</option>
                                                @foreach ($food as $f)
                                                <option value="{{ $f->id }}">{{ $f->nama }} || Rp.{{ $f->harga }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
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