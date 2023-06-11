@extends('app')

@section('content')
    <div class="section-header">
        <h1>Finance Revenue</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Finance Revenue</div>
        </div>
    </div>
    <div class="card mb-2">
        <table class="table table-md mt-1">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Order ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Bus</th>
                    <th scope="col">Total Ticket</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Type</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaction->order_id }}</td>
                        <td>{{ $transaction->contact->email }}</td>
                        <td>{{ $transaction->contact->phone }}</td>
                        <td>{{ $transaction->bus->code_bus }}</td>
                        <td>{{ $transaction->total_ticket }}</td>
                        <td>{{ $transaction->total_price }}</td>
                        <td>{{ $transaction->payment_type }}</td>
                        <td>{{ $transaction->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
@endsection
