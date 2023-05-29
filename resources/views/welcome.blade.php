<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>BOBUS DASHBOARD</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('style/dist/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('style/dist/assets/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="/" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="{{ asset('style/dist/assets/img/avatar/avatar-1.png')}}" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                
                
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('style/dist/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->first_name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/">
                <img src="{{ asset('style/dist/assets/img/logo_bobus-215x215.png')}}" width="50px">
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">
                <img src="{{ asset('style/dist/assets/img/logo_bobus-215x215.png')}}" width="50px">
            </a>
          </div>

          @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO" || auth()->user()->role == "Driver")
          <ul class="sidebar-menu">
            <li class="dropdown active">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li class=active><a class="nav-link" href="/">BoBus Dashboard</a></li>
              </ul>
            </li>
            @endif

            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO")
              <li class="menu-header">Ticket</li>
            @endif

            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO")
              <li><a href="/bookingtiket"><i class="fas fa-columns"></i> <span>Ticket Booking</span></a></li>
            @endif

            @if (auth()->user()->role == "Superadmin" )
              <li><a href="/kategoritiket"><i class="fas fa-th"></i> <span>Ticket Category</span></a></li>
            @endif

            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO" || auth()->user()->role == "Driver")
              <li class="menu-header">Data</li>
            @endif
                
            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO")
              <li><a href="#"><i class="fas fa-user"></i> <span>Customer Data</span></a></li>
              <li><a href="/databus"><i class="far fa-file-alt"></i><span>Bus</span></a></li>
            @endif

            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO" || auth()->user()->role == "Driver" )
              <li><a href="/busstops"><i class="fas fa-map-marker-alt"></i> <span>Bus Stops</span></a></li>
              <li><a href="/rutebus"><i class="fas fa-map"></i> <span>Route Bus</span></a></li>
              <li><a href="/jadwal"><i class="fas fa-calendar"></i> <span>Schedule</span></a></li>
            @endif

            @if (auth()->user()->role == "Superadmin" )
              <li><a class="nav-link" href="/trackbus"><i class="fas fa-location-arrow"></i><span>Track Bus</span></a></li>
            @endif
                
            @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO")
              <li><a href="#"><i class="fas fa-book"></i> <span>Booking Data</span></a></li>

            <li class="menu-header">Report</li>
              <li><a href="#"><i class="fas fa-user"></i> <span>Finance</span></a></li>
            @endif

            <li class="menu-header">Pages</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
              <ul class="dropdown-menu">
               {{-- <li><a href="auth-forgot-password.html">Forgot Password</a></li>  --}}
               <li><a href="login">Login</a></li> 
               <li><a href="register">Register</a></li> 
               {{-- <li><a href="auth-reset-password.html">Reset Password</a></li>  --}}
              </ul>

              @if (auth()->user()->role == "Superadmin" || auth()->user()->role == "Management PO")
                <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>User Management</span></a></li>
              @endif
            </li>           
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
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
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">24</div>
                      <div class="card-stats-item-label">Pending</div>
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
                    59
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                  <div class="card-chart">
                    <canvas id="balance-chart" height="80"></canvas>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Balance</h4>
                    </div>
                    <div class="card-body">
                      $187,13
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
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sales</h4>
                  </div>
                  <div class="card-body">
                    4,732
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('style/dist/assets/modules/jquery.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/popper.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/tooltip.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('style/dist/assets/modules/jquery.sparkline.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/chart.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ asset('style/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('style/dist/assets/js/page/index.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('style/dist/assets/js/scripts.js')}}"></script>
  <script src="{{ asset('style/dist/assets/js/custom.js')}}"></script>
</body>
</html>