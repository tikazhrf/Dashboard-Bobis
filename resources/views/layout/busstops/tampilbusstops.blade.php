@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Bus Stops</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Edit Bus Stops</div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <form action="/updatebusstops/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label>Bus Stops</label>
                                <input type="text" name="bus_stops" class="form-control" required=""
                                    value="{{ $data->bus_stops }}">
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
