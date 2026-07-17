@extends('layouts.front')

@section('title', 'Destinations')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5" style="margin-top: -1px;">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="text-white mb-2">Browse Tours</h1>
                <p class="text-white-50 mb-0">Pick a destination and see upcoming departures.</p>
                @auth
                    @if (Auth::user()->isStaff())
                        <a href="{{ route('admin.tour-packages.create') }}" class="btn btn-light rounded-pill px-4 mt-3">
                            <i class="fa fa-plus me-2"></i>Add Tour Package
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="container py-2 mb-5">
    <form method="GET" action="{{ route('tour-packages.index') }}" class="row g-3 justify-content-center mb-5">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-pill py-2 px-3" placeholder="Search tours (e.g. Angkor)">
        </div>
        <div class="col-md-4">
            <input type="text" name="destination" value="{{ request('destination') }}" class="form-control rounded-pill py-2 px-3" placeholder="Destination (e.g. Siem Reap)">
        </div>
        <div class="col-md-auto">
            <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 w-100">Search</button>
        </div>
    </form>

    <div class="row g-4">
        @forelse ($packages as $package)
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ $package->cover_image ? asset($package->cover_image) : asset('img/destination-1.jpg') }}"
                         class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $package->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $package->title }}</h5>
                        <p class="text-muted mb-2"><i class="fa fa-map-marker-alt me-2"></i>{{ $package->destination }}</p>
                        <p class="card-text text-muted small mb-3">
                            {{ $package->duration_days }} days / {{ $package->duration_nights }} nights
                            &middot; {{ $package->tour_schedules_count }} upcoming {{ Str::plural('departure', $package->tour_schedules_count) }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">${{ number_format($package->price, 2) }}</span>
                            <a href="{{ route('tour-packages.show', $package) }}" class="btn btn-outline-primary rounded-pill px-3">View & Book</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">No tours match your search yet. Try a different destination.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{ $packages->links() }}
    </div>
</div>
@endsection