@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Route</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Edit Route</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/updaterute/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Bus Code</label>
                                <select class="custom-select" name="code_bus_id">
                                    <option value="{{ $data->code_bus }}">{{ ucfirst($data->code_bus) }}</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Origin</label>
                                <select class="custom-select" name="bus_stops_id">
                                    <option value="{{ $data->bus_stops }}">{{ ucfirst($data->bus_stops) }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="number" name="price" class="form-control currency"
                                        value="{{ $data->price }}">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
