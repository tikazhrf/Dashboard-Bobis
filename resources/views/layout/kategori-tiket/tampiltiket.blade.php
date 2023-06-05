@extends('app')

@section('content')
    <div class="section-header">
        <h1>Edit Ticket Category</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Edit Ticket Category</div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <form action="/updatetiket/{{ $data->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col">
                                <label>Ticket Category</label>
                                <input type="text" name="ticket_category" class="form-control" required=""
                                    value="{{ $data->ticket_category }}">
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
