<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">
                <img src="{{ asset('style/dist/assets/img/logo_bobus-215x215.png') }}" width="50px">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">
                <img src="{{ asset('style/dist/assets/img/logo_bobus-215x215.png') }}" width="50px">
            </a>
        </div>

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO' || auth()->user()->role == 'Driver')
            <ul class="sidebar-menu">
                <li class="dropdown active">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        <li class=active><a class="nav-link" href="{{ route('dashboard') }}">BoBus
                                Dashboard</a></li>
                    </ul>
                </li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO')
            <li class="menu-header">Ticket</li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO')
            <li><a href="/bookingtiket"><i class="fas fa-columns"></i> <span>Ticket Booking</span></a>
            </li>
        @endif

        @if (auth()->user()->role == 'Superadmin')
            <li><a href="/kategoritiket"><i class="fas fa-th"></i> <span>Ticket Category</span></a></li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO' || auth()->user()->role == 'Driver')
            <li class="menu-header">Data</li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO')
            <li><a href="#"><i class="fas fa-user"></i> <span>Customer Data</span></a></li>
            <li><a href="/databus"><i class="far fa-file-alt"></i><span>Bus</span></a></li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO' || auth()->user()->role == 'Driver')
            <li><a href="/busstops"><i class="fas fa-map-marker-alt"></i> <span>Bus Stops</span></a></li>
            <li><a href="/rutebus"><i class="fas fa-map"></i> <span>Route Bus</span></a></li>
            <li><a href="/jadwal"><i class="fas fa-calendar"></i> <span>Schedule</span></a></li>
        @endif

        @if (auth()->user()->role == 'Superadmin')
            <li><a class="nav-link" href="/trackbus"><i class="fas fa-location-arrow"></i><span>Track
                        Bus</span></a></li>
        @endif

        @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO')
            <li><a href="#"><i class="fas fa-book"></i> <span>Booking Data</span></a></li>

            <li class="menu-header">Report</li>
            <li><a href="#"><i class="fas fa-user"></i> <span>Finance</span></a></li>
        @endif

        <li class="menu-header">Pages</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i>
                <span>Auth</span></a>
            <ul class="dropdown-menu">
                {{-- <li><a href="auth-forgot-password.html">Forgot Password</a></li>  --}}
                <li><a href="login">Login</a></li>
                <li><a href="register">Register</a></li>
                {{-- <li><a href="auth-reset-password.html">Reset Password</a></li>  --}}
            </ul>

            @if (auth()->user()->role == 'Superadmin' || auth()->user()->role == 'managementPO')
        <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>User
                    Management</span></a></li>
        @endif
        </li>
        </ul>
    </aside>
</div>
