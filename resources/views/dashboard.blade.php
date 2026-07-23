@extends('layouts.front')

@section('title', 'Dashboard')

@section('content')
    <div class="container py-5">


        <div class="row g-4">
            <div class="col-md-6">
                <div class="card p-4">
                    <h3 class="h5">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}</h3>
                    <p class="text-muted">Here's what's coming up on your travels.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-4">
                    <p class="text-muted mb-1">Total Bookings</p>
                    <p class="h2">{{ $totalBookings }}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-4">
                    @if ($upcoming)
                        <p class="text-muted mb-1">Next Trip</p>
                        <p class="h5">{{ $upcoming->tourSchedule->tourPackage->title }}</p>
                        <p class="text-sm text-muted">{{ $upcoming->tourSchedule->departure_date->format('D, M j Y') }}</p>
                    @else
                        <p class="text-muted mb-1">Next Trip</p>
                        <p class="text-muted">No upcoming trips yet.</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($totalBookings > 0)
            <div class="card bg-primary text-white p-4 mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        @if ($upcoming)
                            <p class="text-white-50 text-uppercase mb-1" style="font-size: 0.75rem;">Coming up</p>
                            <h4 class="text-white mb-1">{{ $upcoming->tourSchedule->tourPackage->title }}</h4>
                            <p class="text-white-75 mb-0">
                                {{ $upcoming->tourSchedule->departure_date->format('D, M j Y') }}
                                &middot; {{ $upcoming->number_of_people }} {{ Str::plural('person', $upcoming->number_of_people) }}
                            </p>
                        @else
                            <p class="text-white-50 text-uppercase mb-1" style="font-size: 0.75rem;">Your bookings</p>
                            <h4 class="text-white mb-1">{{ $totalBookings }} {{ Str::plural('booking', $totalBookings) }}</h4>
                            <p class="text-white-75 mb-0">No upcoming trips right now.</p>
                        @endif
                    </div>
                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-light rounded-pill">
                        View Booking
                    </a>
                </div>
            </div>
        @endif

        <div class="card p-4 mt-4 d-flex flex-row gap-3">
            <a href="{{ route('tour-packages.index') }}" class="btn btn-primary rounded-pill">Browse Tours</a>
            <a href="{{ route('tour-guides.index') }}" class="btn btn-outline-primary rounded-pill">Meet the Guides</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-pill">Edit Profile</a>
        </div>
    </div>
@endsection