@extends('layouts.front')

@section('title', 'My Bookings')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">My Bookings</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="list-group list-group-flush">
                @forelse ($bookings as $booking)
                    <div class="list-group-item p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">{{ $booking->booking_code }}</small>
                                <h3 class="h5">{{ $booking->tourSchedule->tourPackage->title }}</h3>
                                <p class="mb-0 text-muted">
                                    {{ $booking->tourSchedule->departure_date->format('D, M j Y') }}
                                    &middot; {{ $booking->number_of_people }} {{ Str::plural('person', $booking->number_of_people) }}
                                    &middot; ${{ number_format($booking->total_price, 2) }}
                                </p>
                            </div>

                            <div class="text-end">
                                <span class="badge {{ $booking->status === 'pending' ? 'bg-warning' : ($booking->status === 'confirmed' ? 'bg-success' : 'bg-secondary') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>

                                @if (! in_array($booking->status, ['cancelled', 'completed']))
                                    <form method="POST" action="{{ route('bookings.cancel', $booking) }}"
                                          onsubmit="return confirm('Cancel this booking?');" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center">
                        <p class="text-muted">You haven't booked a trip yet.</p>
                        <a href="{{ route('tour-packages.index') }}" class="btn btn-primary rounded-pill">Browse Tours</a>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
