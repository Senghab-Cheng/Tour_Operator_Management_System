@extends('layouts.front')

@section('title', $tourPackage->title)

@section('content')
<div class="container-fluid bg-primary py-5 mb-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="text-white mb-2">{{ $tourPackage->title }}</h1>
                <p class="text-white-50 mb-0"><i class="fa fa-map-marker-alt me-2"></i>{{ $tourPackage->destination }}</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-2 mb-5">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-5">
        <div class="col-lg-8">
            <img src="{{ $tourPackage->cover_image ? asset($tourPackage->cover_image) : asset('img/destination-1.jpg') }}"
                 class="img-fluid rounded mb-4 w-100" style="height: 360px; object-fit: cover;" alt="{{ $tourPackage->title }}">

            <p class="mb-4">{{ $tourPackage->description ?? 'No description provided yet.' }}</p>

            <div class="d-flex gap-4 mb-5 text-muted">
                <span><i class="fa fa-calendar-alt me-2"></i>{{ $tourPackage->duration_days }} days / {{ $tourPackage->duration_nights }} nights</span>
                <span><i class="fa fa-tag me-2"></i>${{ number_format($tourPackage->price, 2) }} per person</span>
            </div>

            @if ($tourPackage->itineraryItems->isNotEmpty())
                <h4 class="mb-3">Itinerary</h4>
                <div class="mb-5">
                    @foreach ($tourPackage->itineraryItems as $item)
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge bg-primary rounded-pill">Day {{ $item->day_number }}</span>
                            </div>
                            <div>
                                <h6 class="mb-1">{{ $item->title }}</h6>
                                <p class="text-muted small mb-0">{{ $item->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($tourPackage->reviews->isNotEmpty())
                <h4 class="mb-3">Traveler Reviews</h4>
                @foreach ($tourPackage->reviews as $review)
                    <div class="border-bottom pb-3 mb-3">
                        <strong>{{ $review->user->name }}</strong>
                        <span class="text-warning ms-2">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                        <p class="text-muted mb-0 mt-1">{{ $review->comment }}</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="col-lg-4">
            <h4 class="mb-3">Upcoming Departures</h4>

            @forelse ($tourPackage->tourSchedules as $schedule)
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h6 class="mb-1">{{ $schedule->departure_date->format('D, M j Y') }}</h6>
                        <p class="text-muted small mb-2">
                            @if ($schedule->pickup_point)
                                <i class="fa fa-map-marker-alt me-1"></i>{{ $schedule->pickup_point }}
                                @if ($schedule->pickup_time) &middot; {{ \Carbon\Carbon::parse($schedule->pickup_time)->format('g:i A') }} @endif
                                <br>
                            @endif
                            @if ($schedule->tourGuide)
                                <i class="fa fa-user me-1"></i>Guide: {{ $schedule->tourGuide->name }}<br>
                            @endif
                            <i class="fa fa-chair me-1"></i>{{ $schedule->seatsAvailable() }} seats left
                        </p>

                        @auth
                            @if ($schedule->seatsAvailable() > 0)
                                <form method="POST" action="{{ route('bookings.store') }}" class="d-flex gap-2">
                                    @csrf
                                    <input type="hidden" name="tour_schedule_id" value="{{ $schedule->id }}">
                                    <input type="number" name="number_of_people" min="1" max="{{ $schedule->seatsAvailable() }}"
                                           value="1" class="form-control form-control-sm" style="max-width: 70px;" required>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-pill flex-fill">Book</button>
                                </form>
                            @else
                                <span class="badge bg-secondary">Fully booked</span>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm rounded-pill w-100">Sign in to book</a>
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-muted">No upcoming departures scheduled yet. Check back soon.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection