@extends('app')

@section('content')
    <div class="section-header">
        <h1>Add Bus Stops</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Add Bus Stops</div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <form action="/insertbusstops" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Bus Stops</label>
                            <input type="text" name="bus_stops" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude:</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude:</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" required>
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
