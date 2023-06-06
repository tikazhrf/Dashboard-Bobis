@extends('app')

@section('content')
    <div class="section-header">
        <h1>User Management</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a>User Management</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top mx-auto" src="{{ asset('style/dist/assets/img/new.png') }}" alt="Card image cap"
                    style="width: 10rem; align: middle">
                <div class="card-body">
                    <h5>Management PO</h5>
                    <div class="breadcrumb-item active"><a href="/detailmanagement" class=" col btn btn-primary">Show
                            Details</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top mx-auto" src="{{ asset('style/dist/assets/img/new.png') }}" alt="Card image cap"
                    style="width: 10rem; align: middle">
                <div class="card-body">
                    <h5>Driver</h5>
                    <div class="breadcrumb-item active"><a href="/detaildriver" class=" col btn btn-primary">Show
                            Details</a></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top mx-auto" src="{{ asset('style/dist/assets/img/new.png') }}" alt="Card image cap"
                    style="width: 10rem; align: middle">
                <div class="card-body">
                    <h5>User</h5>
                    <div class="breadcrumb-item active"><a href="/detailuser" class=" col btn btn-primary">Show
                            Details</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
