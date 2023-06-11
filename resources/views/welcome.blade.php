@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats"
                    <div class="card-stats-title">Order Statistics</div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $unpaid }}</div>
                            <div class="card-stats-item-label">Unpaid</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $pending }}</div>
                            <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">{{ $paid }}</div>
                            <div class="card-stats-item-label">Paid</div>
                        </div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">12</div>
                      <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">23</div>
                      <div class="card-stats-item-label">Completed</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaction }}
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-1">
                <div class="card-stats">
                <div class="card-stats-title">Order Statistics - 
                  <div class="dropdown d-inline">
                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">August</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                      <li class="dropdown-title">Select Month</li>
                      <li><a href="#" class="dropdown-item">January</a></li>
                      <li><a href="#" class="dropdown-item">February</a></li>
                      <li><a href="#" class="dropdown-item">March</a></li>
                      <li><a href="#" class="dropdown-item">April</a></li>
                      <li><a href="#" class="dropdown-item">May</a></li>
                      <li><a href="#" class="dropdown-item">June</a></li>
                      <li><a href="#" class="dropdown-item">July</a></li>
                      <li><a href="#" class="dropdown-item active">August</a></li>
                      <li><a href="#" class="dropdown-item">September</a></li>
                      <li><a href="#" class="dropdown-item">October</a></li>
                      <li><a href="#" class="dropdown-item">November</a></li>
                      <li><a href="#" class="dropdown-item">December</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-rupiah-sign" style="color: white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Balance</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalBalance }}
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-users" style="color: white;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Users</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalAkun }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h4>Tickets Sold</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="158px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card gradient-bottom">
                <div class="card-header justify-content-center">
                    <h4>Available Bus Today</h4>
                </div>
                <div class="card-body" id="top-5-scroll">
                    @foreach ($tiketTersedia as $tiket)
                        <div class="alert alert-primary" role="alert">
                            {{ $tiket['code_bus'] }} - {{ $tiket['company_name'] }}
                            <br>
                            Sisa kursi: {{ $tiket['jumlah_tersedia'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $companies !!},
                datasets: [{
                    data: {!! json_encode($tiketTerjual) !!},
                    borderWidth: 2,
                    backgroundColor: [
                        'rgba(63,82,227,.8)',
                        'rgba(254,86,83,.7)',
                        'rgba(63,82,227,.8)',
                    ],
                    borderWidth: 0,
                    borderColor: 'transparent',
                    pointBorderWidth: 0,
                    pointRadius: 3.5,
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                }, ]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 5, // Menentukan interval batasan nilai
                            max: 30, // Nilai maksimum pada sumbu Y
                            callback: function(value, index, values) {
                                if (value % 5 === 0) {
                                    return value;
                                } else {
                                    return '';
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                },
            }
        });
    </script>
@endsection
