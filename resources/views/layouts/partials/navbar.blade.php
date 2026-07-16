<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ route('home') }}" class="navbar-brand p-0">
        <h1 class="text-primary m-0"><i class="fa fa-map-marker-alt me-3"></i>Tourist</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            <a href="{{ route('destination') }}" class="nav-item nav-link {{ request()->routeIs('destination') ? 'active' : '' }}">Destination</a>
            <a href="{{ route('tour-packages.index') }}" class="nav-item nav-link {{ request()->routeIs('tour-packages.*') ? 'active' : '' }}">Tours</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        @auth
            <div class="dropdown">
                <a href="#" class="btn btn-primary rounded-pill py-2 px-4 dropdown-toggle" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('bookings.index') }}">My Bookings</a></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4">Login</a>
        @endauth
    </div>
</nav>
<!-- Navbar End -->
