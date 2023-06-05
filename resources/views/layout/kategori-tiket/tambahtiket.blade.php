@extends('app')

@section('content')
    <div class="section-header">
        <h1>Add Category Ticket</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Add Category Ticket</div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <form action="/inserttiket" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label>Category Name</label>
                                <input type="text" name="ticket_category" class="form-control" required="">
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
