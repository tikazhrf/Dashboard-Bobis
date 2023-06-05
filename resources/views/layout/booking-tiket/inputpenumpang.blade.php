@extends('app')

@section('content')
    <div class="section-header">
        <h1>Passenger Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Ticket Booking</div>
            <div class="breadcrumb-item">Passenger Details</div>
        </div>
    </div>
    <form action="{{ route('penumpang.store') }}" method="POST">
        @csrf
        <input type="hidden" name="selectedSeats" value="{{ json_encode($selectedSeats) }}">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-circle-user mr-2" style="color:#6777ef"></i>
                            <h6 class="mb-0">Passenger Information</h6>
                        </div>
                        <hr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($bookingTikets as $bookingTiket)
                            <div class="card shadow mb-3">
                                <div class="card-body">
                                    <p>Passenger {{ $no++ }} | <span style="font-weight:bold;">Seat
                                            {{ $bookingTiket->seat }}</span></p>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name"
                                            name="bookingTikets[{{ $bookingTiket->id }}][name]">
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control" id="age"
                                            name="bookingTikets[{{ $bookingTiket->id }}][age]">
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex align-items-center mt-5">
                            <i class="fa-regular fa-address-card mr-2" style="color:#6777ef"></i>
                            <h6 class="mb-0">Contact Details</h6>
                        </div>
                        <hr>
                        <div class="card shadow mb-5">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <h5 class="mb-0 mr-2">Total Amount:</h5>
                                <h5 class="mb-0">Rp.
                                    {{ $bookingTikets[0]->buses->jadwals->rutes->price * count($bookingTikets) }}
                                </h5>
                            </div>
                            <input type="hidden" name="total_price"
                                value="{{ $bookingTikets[0]->buses->jadwals->rutes->price * count($bookingTikets) }}">
                            <button type="submit" class="btn btn-primary">Proceed to Pay</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-calendar mr-2" style="color:#6777ef"></i>
                            <h6 class="mb-0">Departure Information</h6>
                        </div>
                        <hr>
                        <p class="mb-0">Departure Date:</p>
                        <p>{{ $bookingTikets[0]->buses->jadwals->start_at }}</p>
                        <p class="mb-0">From:</p>
                        <p>{{ $bookingTikets[0]->buses->jadwals->rutes->origin->bus_stops }}</p>
                        <p class="mb-0">To:</p>
                        <p>{{ $bookingTikets[0]->buses->jadwals->rutes->destination->bus_stops }}</p>
                        <p class="mb-0">Bus:</p>
                        <p>{{ $bookingTikets[0]->buses->code_bus }}</p>
                        <p class="mb-0">Seat Number:</p>
                        <ol style="padding-inline-start: 15px;">
                            @foreach ($selectedSeats as $selectedSeat)
                                <li>{{ $selectedSeat['seat_numbers'] . ' - ' . $selectedSeat['seat_type'] }}</li>
                            @endforeach
                        </ol>
                        <p class="mb-0">Price 1 Ticket</p>
                        <p>{{ $bookingTikets[0]->buses->jadwals->rutes->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
@endsection
