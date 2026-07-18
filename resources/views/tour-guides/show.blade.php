@extends('layouts.front')

@section('title', $tourGuide->name)

@section('content')
<div class="container py-5 mb-5">
    <div class="row g-5">
        <div class="col-lg-4 text-center">
            <img src="{{ $tourGuide->photo ? asset($tourGuide->photo) : asset('img/touristInCam.jpeg') }}"
                 class="rounded-circle shadow-sm mb-3" style="width: 220px; height: 220px; object-fit: cover;"
                 alt="{{ $tourGuide->name }}">
            <h3 class="mb-1">{{ $tourGuide->name }}</h3>
            <p class="text-muted mb-3">
                @if ($tourGuide->email)<i class="fa fa-envelope me-1"></i>{{ $tourGuide->email }}<br>@endif
                @if ($tourGuide->phone)<i class="fa fa-phone-alt me-1"></i>{{ $tourGuide->phone }}@endif
            </p>
            <div>
                @foreach ($tourGuide->skillList() as $skill)
                    <span class="badge bg-primary rounded-pill me-1 mb-1">{{ $skill }}</span>
                @endforeach
            </div>
        </div>

        <div class="col-lg-8">
            <h4 class="mb-3">About</h4>
            <p class="text-muted mb-5">{{ $tourGuide->bio ?? 'No bio provided yet.' }}</p>

            <h4 class="mb-3">Upcoming Trips</h4>
            @forelse ($tourGuide->tourSchedules as $schedule)
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                    <div>
                        <h6 class="mb-1">{{ $schedule->tourPackage->title }}</h6>
                        <p class="text-muted small mb-0">
                            <i class="fa fa-calendar-alt me-1"></i>{{ $schedule->departure_date->format('D, M j Y') }}
                        </p>
                    </div>
                    <a href="{{ route('tour-packages.show', $schedule->tourPackage) }}" class="btn btn-outline-primary btn-sm rounded-pill">View Tour</a>
                </div>
            @empty
                <p class="text-muted">No upcoming trips assigned right now.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection