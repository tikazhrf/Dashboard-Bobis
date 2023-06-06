@extends('app')

@section('content')
    <div class="section-header">
        <h1>Detail User</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
            <div class="breadcrumb-item"><a>Detail User</a></div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Detail User</h4>
                <div class="card-header-form">
                    <form>
                        <div class="input-group">
                            <form action="rutebus" method="get">
                                <input type="search" class="form-control" placeholder="Search" name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                                <a href="/tambahrute" class="btn btn-primary">Add User</a>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($data as $row)
                            <tr>
                                <th scope="row">{{ $row->id }}</th>
                                <td>{{ $row->first_name }} {{ $row->last_name }}</td>
                                <td>{{ $row->image }}</>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->notelp }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->role }}</td>
                                <td>
                                    <a href="/tampilmanagement/{{ $row->id }}"
                                        class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                                    <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete"></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            </section>
        </div>
    </div>
@endsection
@section('script')
@endsection
