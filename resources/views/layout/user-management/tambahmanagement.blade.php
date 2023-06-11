@extends('app')

@section('content')
    <div class="section-header">
        <h1>Add Management PO</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Add Management PO</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="/insertmanagement" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Name</label>
                                <input type="text" name="first_name" class="form-control" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" required=""">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required="">
                            </div>
                            <div class="form-group col-6">
                                <label>No. Telp</label>
                                <input type="number" name="notelp" class="form-control" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" required=""">
                            </div>
                            <div class="form-group col-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Role</label>
                                <select class="custom-select" name="role" id="role"
                                    aria-label="Default select example">
                                    <option selected>{{ $data->role }}</option>
                                    <option value="Superadmin">Superadmin</option>
                                    <option value="managementPO">managementPO</option>
                                    <option value="Driver">Driver</option>
                                </select>
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
