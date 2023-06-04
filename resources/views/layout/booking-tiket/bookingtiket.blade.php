@extends('app')

@section('content')
    <div class="section-header">
        <h1>Ticket Booking</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/">Bobus Dashboard</a></div>
            <div class="breadcrumb-item">Ticket Booking</div>
        </div>
    </div>
    <div class="card mb-2" style="height:7rem">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="inputFrom">From</label>
                    <input type="text" class="form-control" id="inputFrom" placeholder="Origin">
                </div>
                <div class="d-flex justify-content-center align-items-center fa fa-arrow-alt-circle-right">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputTo">To</label>
                    <input type="text" class="form-control" id="inputTo" placeholder="Destination">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputDate">Date</label>
                    <input type="date" class="form-control" id="inputDate" placeholder="Date">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-2">
        <table>
            <tr>
                <th class="col-2">Departure Time</th>
                <th class="col-4">Route</th>
                <th class="col-2">Seat</th>
                <th class="col-2">Price</th>
                <th class="col-2">Seat Available</th>
            </tr>
        </table>
    </div>
    @foreach ($dataBus as $item)
        <div class="card mb-2">
            <table class="table table-md mt-1">
                <tr>
                    <td class="col-2">{{ $item->jadwals->start_at }}</td>
                    <td class="col-4">{{ $item->jadwals->rutes->origin->bus_stops }} <i
                            class="fa-solid fa-chevron-right mx-5"></i>
                        {{ $item->jadwals->rutes->destination->bus_stops }}</td>
                    <td class="col-2">{{ $item->total_seats }}</td>
                    <td class="col-2">{{ $item->jadwals->rutes->price }}</td>
                    <td class="col-2">{{ $item->total_seats - $tiketBook }}</td>
                </tr>
            </table>
            <hr class="m-0">
            <table class="table table-md mb-0">
                <tr>
                    <td class="col-2">
                        <img src="{{ asset('busimage/' . $item->image) }}" alt="" style="width: 30px;">
                    </td>
                    <td class="col-2">{{ $item->namapo }}</td>
                    <td class="col-2"></td>
                    <td class="col-2"></td>
                    <td class="col-2"></td>
                    <td class="col-2">
                        <a href="#" class="btn btn-primary text-align-right"
                            onclick="showSeatSelection(event, '{{ $item->id }}')">View Seat</a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Seat Selection -->
        <div class="card seat-map p-5" id="seatMap_{{ $item->id }}" style="display: none; background-color: #DBDBDB;">
            <div class="row align-items-center justify-content-center">
                @php
                    $totalSeats = $item->total_seats;
                    $selectedSeats = [];
                    $bookedSeats = $seatsArray; // booked seats
                    $disabilitySeats = [3, 4, 5, 6]; // disability seats
                    $pregnantSeats = [26, 27, 28]; // pregnant seats
                    $rowCount = 4; // jumlah baris
                    
                    // Jumlah kursi pada baris 1
                    $columnCount1 = min(9, ceil($totalSeats / 4));
                    
                    // Jumlah kursi pada baris 2
                    $columnCount2 = $columnCount1;
                    
                    // Jumlah kursi pada baris 3 dan 4
                    $remainingSeats = $totalSeats - ($columnCount1 + $columnCount2);
                    
                    // Jika totalSeats ganjil, berikan selisih 1 pada columnCount3
                    if ($remainingSeats % 2 != 0) {
                        $columnCount3 = ceil($remainingSeats / 2);
                        $columnCount4 = floor($remainingSeats / 2);
                    } else {
                        $columnCount3 = $remainingSeats / 2;
                        $columnCount4 = $remainingSeats / 2;
                    }
                @endphp
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-start">
                                <img src="{{ asset('busimage/Driver.png') }}" class="mr-3" alt="">
                                <div class="front"></div>
                                <div class="seat-row">
                                    @php
                                        $seat = 1;
                                    @endphp

                                    @for ($row = 1; $row <= $rowCount; $row++)
                                        <div class="seat-col">
                                            @for ($col = 1; $col <= ${"columnCount$row"}; $col++)
                                                @php
                                                    $seatLabel = chr(64 + $col) . $row;
                                                    $seatClass = '';
                                                    if (in_array($seatLabel, $bookedSeats)) {
                                                        $seatClass = 'unavailable';
                                                    } elseif (in_array($seat, $selectedSeats)) {
                                                        $seatClass = 'selected';
                                                    } elseif (in_array($seat, $disabilitySeats)) {
                                                        $seatClass = 'disability';
                                                    } elseif (in_array($seat, $pregnantSeats)) {
                                                        $seatClass = 'pregnant';
                                                    } else {
                                                        $seatClass = 'available';
                                                    }
                                                    $seat++;
                                                @endphp

                                                <div class="seat {{ $seatClass }}" data-seat="{{ $seatLabel }}">
                                                    {{ $seatLabel }}
                                                </div>
                                            @endfor
                                        </div>
                                        @if ($row == 2)
                                            <div class="row-gap my-4"></div>
                                        @endif
                                    @endfor
                                </div>
                            </div>

                            <div class="seat-note mt-5">
                                <div class="seat-status">
                                    <div class="available"></div>
                                    <span>Umum</span>
                                </div>
                                <div class="seat-status">
                                    <div class="selected"></div>
                                    <span>Dipilih</span>
                                </div>
                                <div class="seat-status">
                                    <div class="pregnant"></div>
                                    <span>Ibu Hamil</span>
                                </div>
                                <div class="seat-status">
                                    <div class="disability"></div>
                                    <span>Disabilitas</span>
                                </div>
                                <div class="seat-status">
                                    <div class="unavailable"></div>
                                    <span>Tidak Tersedia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h3>Informasi Tiket</h3>
                            <div class="table-responsive">
                                <table class="table table-borderless" id="table-information">
                                    <tbody>
                                        <tr>
                                            <td>Rute</td>
                                            <td>:</td>
                                            <td>{{ $item->jadwals->rutes->origin->bus_stops }}<i
                                                    class="fa-solid fa-chevron-right mx-2"></i>{{ $item->jadwals->rutes->destination->bus_stops }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tiket Pesanan</td>
                                            <td>:</td>
                                            <td id="selectedSeats"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga Tiket</td>
                                            <td>:</td>
                                            <td><span id="totalPrice"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bus_id" value="{{ $item->id }}">
                                    <input type="hidden" name="selected_seats" id="selectedSeatsInput">
                                    <input type="hidden" name="seat_category_id" id="seatCategoryIdInput">

                                    <button type="submit" class="btn btn-primary" id="selectSeatButton"
                                        style="display: none;">Pesan Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        function showSeatSelection(event, seatMapId) {
            event.preventDefault();
            $('#seatMap_' + seatMapId).slideToggle();
        }

        $(document).ready(function() {
            var seatPrice = {{ $item->jadwals->rutes->price }};
            var totalPrice = 0;
            var seatStatus = 'Belum Memilih Kursi';

            $('#totalPrice').text(formatCurrency(totalPrice));
            $('#selectedSeats').html(seatStatus);

            $('.seat.available, .seat.disability, .seat.pregnant').click(function() {
                $(this).toggleClass('selected');
                var selectedSeats = $('.seat.selected').map(function() {
                    return {
                        seat: $(this).text().trim(),
                        category: $(this).hasClass('disability') ? 'Disabilitas' : ($(this)
                            .hasClass('pregnant') ? 'Ibu Hamil' : 'Umum')
                    };
                }).get();

                var seatList = selectedSeats.map(function(seat) {
                    return '<li class="list-group-item d-flex align-items-center px-0">' +
                        seat.seat +
                        '<span class="ml-2 badge bg-primary rounded-pill text-white">' +
                        seat.category + '</span>' + '</li>';
                }).join('');


                if (selectedSeats.length > 0) {
                    seatStatus = '<ul class="list-group list-group-flush">' + seatList + '</ul>';
                    totalPrice = seatPrice * selectedSeats.length;
                    $('#selectedSeatsInput').val(JSON.stringify(selectedSeats.map(seat => seat.seat)));
                    $('#seatCategoryIdInput').val(JSON.stringify(selectedSeats.map(seat => seat.category)));
                    $('#selectSeatButton').show();
                } else {
                    seatStatus = 'Belum Memilih Kursi';
                    totalPrice = 0;
                    $('#selectedSeatsInput').val('');
                    $('#seatCategoryIdInput').val('');
                    $('#selectSeatButton').hide();
                }

                $('#selectedSeats').html(seatStatus);
                $('#totalPrice').text(formatCurrency(totalPrice));
            });

            function formatCurrency(value) {
                return 'Rp ' + value.toLocaleString('id-ID');
            }
        });
    </script>
@endsection
