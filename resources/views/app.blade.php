<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <title>BOBUS DASHBOARD</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('style/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('style/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('style/dist/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/dist/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

    <script src="https://kit.fontawesome.com/c998beae83.js" crossorigin="anonymous"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    @include('sweetalert::alert')

    <div id="app">

        <div class="main-wrapper main-wrapper-1">

            @include('partials.navbar')

            @include('partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('style/dist/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('style/dist/assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('style/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('style/dist/assets/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('style/dist/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('style/dist/assets/js/custom.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

    @yield('script')
</body>

</html>
