<!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Tourist</h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
               <div class="navbar-nav ms-auto py-0">

                <a href="{{ route('home') }}" 
                    class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                 </a>

                <a href="{{ route('about') }}" 
                    class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ route('services') }}" 
                    class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                    Services
                </a>

                <a href="{{ route('destination') }}" 
                    class="nav-item nav-link {{ request()->routeIs('destination') ? 'active' : '' }}">
                     Destination
                 </a>

                <a href="{{ route('contact') }}" 
                    class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>

    </div>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill py-2 px-4 me-2">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary rounded-pill py-2 px-4">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill py-2 px-4 me-2">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill py-2 px-4">Sign Up</a>
                @endauth
            </div>
        </nav>

        
    <!-- Navbar & Hero End -->