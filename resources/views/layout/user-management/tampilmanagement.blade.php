@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Management PO</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobis Dashboard</a></div>
            <div class="breadcrumb-item">Edit Management PO</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <form action="{{ route('update.user', $data->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required
                                    value="{{ $data->first_name }}">
                            </div>
                            <div class="form-group col-6">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required
                                    value="{{ $data->last_name }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required
                                    value="{{ $data->email }}">
                            </div>
                            <div class="form-group col-6">
                                <label>No. Telp</label>
                                <input type="number" name="notelp" class="form-control" required
                                    value="{{ $data->notelp }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ $data->address }}</textarea>
                            </div>
                            <div class="form-group col-6">
                                <label>Role</label>
                                <select class="custom-select" name="role" id="role"
                                    aria-label="Default select example" required>
                                    <option value="{{ $data->role }}" selected>{{ ucfirst($data->role) }}</option>
                                    <option value="managementPO">managementPO</option>
                                    <option value="Driver">Driver</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label>Status</label>
                                <select class="custom-select" name="status" id="status"
                                    aria-label="Default select example" required>
                                    <option selected>{{ ucfirst($data->status) }}</option>
                                    <option value="Umum">Umum</option>
                                    <option value="Ibu Hamil">Ibu Hamil</option>
                                    <option value="Disabilitas">Disabilitas</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" value="{{ $data->image }}">
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
