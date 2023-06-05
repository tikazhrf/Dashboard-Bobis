@extends('app')

@section('content')
    <div class="section-header">
        <h1>Checkout</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Ticket Booking</div>
            <div class="breadcrumb-item">Passenger Details</div>
            <div class="breadcrumb-item">Checkout</div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <h3>Transaction Details</h3>
                    <hr>
                    <table class="table">
                        <tr>
                            <th>Order ID</th>
                            <td>{{ $transactionDetails['order_id'] }}</td>
                        </tr>
                        <tr>
                            <th>Total Tickets</th>
                            <td>{{ count($items) }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>{{ $transactionDetails['gross_amount'] }}</td>
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
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['passenger'] }}</td>
                            </tr>
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
                            <td>{{ $customerDetails['email'] }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $customerDetails['phone'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <button id="pay-button" class="btn btn-primary btn-lg mt-5">Proceed to Pay</button>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    window.location.href = '/invoice/{{ $transaction }}'
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
