@extends('app')

@section('content')
    <div class="section-header">
        <h1>Invoice</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Invoice Payment</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Transaction Details</h3>
                        @if ($transaction->payment_status == 'Paid')
                            <h3 class="text-right text-success">{{ $transaction->payment_status }}</h3>
                        @else
                            <h3 class="text-right text-danger">{{ $transaction->payment_status }}</h3>
                        @endif
                    </div>
                    <hr>
                    <table class="table">
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $transaction->order_id }}</td>
                        </tr>
                        <tr>
                            <th>Total Tickets</th>
                            <td>{{ $transaction->total_ticket }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>{{ $transaction->total_price }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>Items</h3>
                    <hr>
                    <table class="table">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Seat</th>
                            <th>Passenger</th>
                        </tr>
                        @foreach ($transaction->contact->penumpang as $penumpang)
                            @foreach ($penumpang->bookingTikets as $bookingTiket)
                                <tr>
                                    <td>{{ $bookingTiket->id }}</td>
                                    <td>{{ $bookingTiket->buses->jadwals->rutes->price }}</td>
                                    <td>1</td>
                                    <td>{{ $bookingTiket->seat }}</td>
                                    <td>{{ $penumpang->name }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h3>Customer Details</h3>
                    <hr>
                    <table class="table">
                        <tr>
                            <th>Email</th>
                            <td>{{ $transaction->contact->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $transaction->contact->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
