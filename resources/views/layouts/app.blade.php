<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Tourist')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- CSS -->
    <link href="{{ asset('css_js/lib/animate/animate.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css_js/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css_js/css/style.css') }}" rel="stylesheet">
</head>

<body>
    @include('partials.topbar')
    @include('partials.spinner')

    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('css_js/lib/wow/wow.min.js') }}"></script>

    <script src="{{ asset('css_js/lib/easing/easing.min.js') }}"></script>

    <script src="{{ asset('css_js/lib/waypoints/waypoints.min.js') }}"></script>

    <script src="{{ asset('css_js/js/main.js') }}"></script>

</body>

</html>