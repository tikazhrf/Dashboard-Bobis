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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
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
            <li class="menu-header">Dashboard</li>
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
              <li><a href="/rutebus"><i class="fas fa-map"></i> <span>Route</span></a></li>
              <li><a href="/jadwal"><i class="fas fa-calendar"></i> <span>Schedule</span></a></li>
            @endif

            @if (auth()->user()->role == "Superadmin" )
              <li><a class="nav-link" href="/trackbus"><i class="fas fa-map-marker-alt"></i><span>Track Bus</span></a></li>
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
                <li><a class="nav-link" href="/usermanagement"><i class="fas fa-pencil-ruler"></i> <span>User Management</span></a></li>
              @endif
            </li>           
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Route Bus</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a>Route Bus</a></div>
            </div>
          </div>
          <div class="card-header-form">
            
            {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
              {{ $message }}
            </div>
            @endif --}}
          <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h4>Route Bus</h4>
                <div class="card-header-form">
                <form>
                  <div class="input-group">
                    <form action="rutebus" method="get">
                    <input type="search" class="form-control" placeholder="Search" name="search">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                    <a  href="/tambahrute" class="btn btn-primary">Add Route</a>
                    {{-- Session::get('halaman_url') --}}
                    </form>
                  </div>
                </form>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped table-md">
                    <tr>
                      <th>#</th>
                      <th>Bus Code</th>
                      <th>Origin</th>
                      <th>Destination</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                    @php
                        $no = 1;   
                    @endphp
                    @foreach ($data as $index => $row)
                    <tr>
                      <th scope="row">{{ $index + $data->firstItem() }}</th>
                      <td>{{ $row->code_bus }}</td>
                      <td>{{ $row->origin }}</td>
                      <td>{{ $row->destination }}</td>
                      <td>{{ $row->price }}</td>
                      <td>
                        <a href="/tampilrute/{{ $row->id }}" class="btn btn-warning rounded-circle fa fa-pencil-alt"></a>
                        <a href="#" class="btn btn-danger rounded-circle fa fa-trash delete" data-id="{{ $row->id }}" data-nama="{{ $row->code_bus }}"></a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
              </div>
              <div class="card-footer text-right">
                <nav class="d-inline-block">
                  <ul class="pagination mb-0">
                    {{ $data->links() }}  
                  </ul>
                </nav>
              </div>
            </div>
          </div>
          </div>
        </section>
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

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
<script>
  $('.delete').click( function() {
    var ruteid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    swal({
          title: "Are you sure?",
          text: "You will clear route with Code Bus "+nama+" ",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
            window.location = "/deleterute/"+ruteid+""
            swal("The route has been successfully deleted!", {
              icon: "success",
            });
          } else {
            swal (
              {
                text: " "+nama+" is not deleted!"
              });
          }
      });
  });

</script>
<script>
  @if (Session::has('success'))
    toastr.success("{{  Session::get('success') }}")
  @endif
</script>
</html>