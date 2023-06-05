@php
    use App\Models\BookingTiket;
@endphp
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
                <div class="d-flex justify-content-center align-items-center fa fa-arrow-alt-circle-right"></div>
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
        @php
            $seatsArray = BookingTiket::where('buses_id', $item->id)
                ->pluck('seat')
                ->toArray();
            $tiketBook = 0;
            foreach ($seatsArray as $seats) {
                $seats = explode(',', $seats);
                $tiketBook += count($seats);
            }
            $availableSeats = $item->total_seats - $tiketBook;
        @endphp
        <div class="card mb-2">
            <table class="table table-md mt-1">
                <tr>
                    <td class="col-2">{{ $item->jadwals->start_at }}</td>
                    <td class="col-4">{{ $item->jadwals->rutes->origin->bus_stops }} <i
                            class="fa-solid fa-chevron-right mx-5"></i>
                        {{ $item->jadwals->rutes->destination->bus_stops }}</td>
                    <td class="col-2">{{ $item->total_seats }}</td>
                    <td class="col-2">{{ $item->jadwals->rutes->price }}</td>
                    <td class="col-2">{{ $availableSeats }}</td>
                </tr>
            </table>
            <hr class="m-0">
            <table class="table table-md mb-0">
                <tr>
                    <td class="col-2">
                        <img src="{{ asset('busimage/' . $item->image) }}" alt="" style="width: 30px;">
                    </td>
                    <td class="col-2">{{ $item->company->company_name }}</td>
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
                    <div class="card" id="cardSeat_{{ $item->id }}">
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
                                                    if (in_array($seatLabel, $seatsArray)) {
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

                                                <div class="seat {{ $seatClass }}" data-seat="{{ $seatLabel }}"
                                                    onclick="selectSeat('{{ $item->id }}', '{{ $seatLabel }}')">
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
                    <div class="card" id="ticketInfo_{{ $item->id }}">
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
                                            <td id="selectedSeats_{{ $item->id }}">Belum Memilih Kursi</td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga Tiket</td>
                                            <td>:</td>
                                            <td id="totalPrice_{{ $item->id }}">Rp. 0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <form action="{{ route('booking.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bus_id" value="{{ $item->id }}">
                                    <input type="hidden" name="selected_seats"
                                        id="selectedSeatsInput_{{ $item->id }}">
                                    <input type="hidden" name="seat_category_id"
                                        id="seatCategoryIdInput_{{ $item->id }}">

                                    <button type="submit" class="btn btn-primary"
                                        id="selectSeatButton_{{ $item->id }}" style="display: none;">Pesan
                                        Sekarang</button>
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
        let selectedSeats = {};

        function selectSeat(itemId, seatLabel) {
            const seatElement = document.querySelector(`#seatMap_${itemId} .seat[data-seat='${seatLabel}']`);

            if (seatElement.classList.contains('unavailable')) {
                // Kursi tidak tersedia
                return;
            }

            if (!selectedSeats[itemId]) {
                selectedSeats[itemId] = [];
            }

            if (selectedSeats[itemId].includes(seatLabel)) {
                // Hapus kursi jika sudah dipilih
                selectedSeats[itemId] = selectedSeats[itemId].filter(seat => seat !== seatLabel);
                seatElement.classList.remove('selected');
            } else {
                // Tambahkan kursi jika belum dipilih
                selectedSeats[itemId].push(seatLabel);
                seatElement.classList.add('selected');
            }

            updateSelectedSeats(itemId);
            updateTotalPrice(itemId);
        }


        function updateSelectedSeats(itemId) {
            const selectedSeatsElement = document.querySelector(`#selectedSeats_${itemId}`);

            const selectedSeatsData = selectedSeats[itemId].map(seatLabel => {
                let seatCategory = '';
                const seatElement = document.querySelector(`#seatMap_${itemId} .seat[data-seat='${seatLabel}']`);
                if (seatElement.classList.contains('disability')) {
                    seatCategory = 'Disabilitas';
                } else if (seatElement.classList.contains('pregnant')) {
                    seatCategory = 'Ibu Hamil';
                } else {
                    seatCategory = 'Umum';
                }
                return {
                    seat: seatLabel,
                    category: seatCategory
                };
            });

            const selectedSeatsLabels = selectedSeatsData.map(data => `${data.seat} - ${data.category}`);
            selectedSeatsElement.innerHTML = selectedSeatsLabels.length > 0 ? selectedSeatsLabels.join(', ') :
                'Belum Memilih Kursi';

            const selectedSeatsInput = document.querySelector(`#selectedSeatsInput_${itemId}`);
            const seatLabels = selectedSeatsData.map(seat => seat.seat);
            selectedSeatsInput.value = JSON.stringify(seatLabels);

            const seatCategoryIdInput = document.querySelector(`#seatCategoryIdInput_${itemId}`);
            const seatCategories = selectedSeatsData.map(data => data.category);
            seatCategoryIdInput.value = JSON.stringify(seatCategories);

            const selectSeatButton = document.querySelector(`#selectSeatButton_${itemId}`);
            selectSeatButton.style.display = selectedSeats[itemId].length > 0 ? 'block' : 'none';
        }


        function updateTotalPrice(itemId) {
            const totalPriceElement = document.querySelector(`#totalPrice_${itemId}`);
            const seatCategoryIdInput = document.querySelector(`#seatCategoryIdInput_${itemId}`);

            // Perform calculation based on selected seats and seat category
            const pricePerSeat = {{ $item->jadwals->rutes->price }};
            const totalPrice = selectedSeats[itemId].length * pricePerSeat;

            totalPriceElement.innerHTML = `Rp. ${totalPrice}`;
        }

        function showSeatSelection(event, seatMapId) {
            event.preventDefault();
            $('#seatMap_' + seatMapId).slideToggle();
        }
    </script>
@endsection
