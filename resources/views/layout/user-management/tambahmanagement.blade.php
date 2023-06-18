@extends('app')

@section('content')
    <div class="section-header">
        <h1>Add User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobis Dashboard</a></div>
            <div class="breadcrumb-item">Add User</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('store.user') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>No. Telp</label>
                                <input type="number" name="notelp" class="form-control" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Role</label>
                                <select class="custom-select" name="role" id="role"
                                    aria-label="Default select example" required>
                                    <option value="managementPO">managementPO</option>
                                    <option value="Driver">Driver</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Status</label>
                                <select class="custom-select" name="status" id="status"
                                    aria-label="Default select example" required>
                                    <option value="Umum">Umum</option>
                                    <option value="Ibu Hamil">Ibu Hamil</option>
                                    <option value="Disabilitas">Disabilitas</option>
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
