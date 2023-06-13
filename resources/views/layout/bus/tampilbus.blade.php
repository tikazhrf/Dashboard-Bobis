@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Bus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobis Dashboard</a></div>
            <div class="breadcrumb-item">Edit Bus</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/updatebus/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            @if (Auth::user()->role == 'Superadmin')
                                <div class="form-group col-6">
                                    <label for="company">Company</label>
                                    <select class="custom-select" name="company">
                                        <option value="{{ $data->company_id }}" selected>{{ $data->company->company_name }}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="form-group col-6">
                                <label>Logo</label>
                                <input type="file" name="image" class="form-control" required=""
                                    value="{{ $data->image }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Bus Code</label>
                                <input type="text" name="code_bus" class="form-control" required=""
                                    value="{{ $data->code_bus }}">
                            </div>
                            <div class="form-group col-6">
                                <label>VIN</label>
                                <input type="text" name="vin" class="form-control" required=""
                                    value="{{ $data->vin }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Plate Number</label>
                                <input type="text" name="plate_number" class="form-control" required=""
                                    value="{{ $data->plate_number }}">
                            </div>
                            <div class="form-group col-6">
                                <label>BPKB Expired</label>
                                <input type="date" name="bpkb_expired" class="form-control" required=""
                                    value="{{ $data->bpkb_expired }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Driver</label>
                                <input type="text" name="driver" class="form-control" required=""
                                    value="{{ $data->driver }}">
                            </div>
                            <div class="form-group col-6">
                                <label>Seat</label>
                                <input type="number" name="total_seats" class="form-control" required=""
                                    value="{{ $data->total_seats }}">
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
