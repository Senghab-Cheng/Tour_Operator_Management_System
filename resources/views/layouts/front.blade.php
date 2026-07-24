<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Tour Operator') }} - @yield('title', 'Home')</title>

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css_js/lib/animate/animate.min.css') }}">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css_js/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css_js/css/style.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>

    @include('partials.spinner')

    @include('partials.topbar')

    @include('partials.navbar')

    <div class="mt-5 pt-5">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('css_js/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('css_js/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('css_js/lib/waypoints/waypoints.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('css_js/js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>