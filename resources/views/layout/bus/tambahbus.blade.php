@extends('app')

@section('content')
    <div class="section-header">
        <h1>Add Bus</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobis Dashboard</a></div>
            <div class="breadcrumb-item">Add Bus</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/insertbus" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Company</label>
                                <input type="text" name="namapo" class="form-control" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>Logo</label>
                                <input type="file" name="image" class="form-control" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Bus Code</label>
                                <input type="text" name="code_bus" class="form-control" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>VIN</label>
                                <input type="text" name="vin" class="form-control" required="">
                                @error('vin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Plate Number</label>
                                <input type="text" name="plate_number" class="form-control" required="">
                                @error('plate_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>BPKB Expired</label>
                                <input type="date" name="bpkb_expired" class="form-control" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Driver</label>
                                <input type="text" name="driver" class="form-control" required="">
                                @error('driver')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Seat</label>
                                <input type="number" name="total_seats" class="form-control" required="">
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
