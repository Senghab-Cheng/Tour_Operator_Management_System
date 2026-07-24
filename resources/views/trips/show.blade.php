@extends('layouts.front')

@section('title', 'Trip Details')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="mb-4">
                {{ $tourSchedule->tourPackage->title }} &mdash; {{ $tourSchedule->departure_date->format('M j, Y') }}
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Trip summary --}}
            <div class="card p-4 mb-4">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <p class="text-muted mb-1">Status</p>
                        <p class="fw-bold">{{ ucfirst($tourSchedule->status) }}</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-muted mb-1">Guide</p>
                        <p class="fw-bold">{{ $tourSchedule->tourGuide->name ?? 'Unassigned' }}</p>
                    </div>
                    <div class="col-sm-4">
                        <p class="text-muted mb-1">Seats</p>
                        <p class="fw-bold">{{ $tourSchedule->seats_booked }} / {{ $tourSchedule->max_seats }} booked</p>
                    </div>
                </div>
            </div>

            {{-- Manage Tour Guide --}}
            <div class="card p-4 mb-4 bg-light">
                <h3 class="h5 mb-3 text-primary">Manage Tour Guide</h3>
                <form method="POST" action="{{ route('admin.tour-schedules.update', $tourSchedule) }}" class="row g-3 align-items-end">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-8">
                        <label for="tour_guide_id_edit" class="form-label">Assign or Change Guide</label>
                        <select name="tour_guide_id" id="tour_guide_id_edit" class="form-select">
                            <option value="">-- Unassigned --</option>
                            @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}" @selected($tourSchedule->tour_guide_id === $guide->id)>
                                    {{ $guide->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary w-100">Update Guide</button>
                    </div>
                </form>
            </div>

            {{-- Roster --}}
            <div class="card p-4 mb-4">
                <h3 class="h5 mb-3">Traveler Roster</h3>
                <div class="list-group list-group-flush">
                    @forelse ($tourSchedule->bookings as $booking)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 fw-bold">{{ $booking->user->name }}</p>
                                <small class="text-muted">{{ $booking->number_of_people }} {{ Str::plural('person', $booking->number_of_people) }} &middot; {{ $booking->booking_code }}</small>
                            </div>
                            <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                        </div>
                    @empty
                        <div class="p-2 text-muted">No bookings yet for this trip.</div>
                    @endforelse
                </div>
            </div>

            {{-- Guide comments --}}
            <div class="card p-4">
                <h3 class="h5 mb-3">Comments from Tour Guide</h3>

                <div class="mb-4">
                    @forelse ($tourSchedule->comments as $comment)
                        <div class="border-start border-3 border-primary ps-3 mb-3">
                            <p class="mb-0">{{ $comment->comment }}</p>
                            <small class="text-muted">
                                &mdash; {{ $comment->tourGuide->name }}
                                (logged by {{ $comment->postedBy->name }}, {{ $comment->created_at->diffForHumans() }})
                            </small>
                        </div>
                    @empty
                        <p class="text-muted">No comments logged for this trip yet.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('admin.trips.comments.store', $tourSchedule) }}" class="border-top pt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="tour_guide_id" class="form-label">On behalf of</label>
                        <select name="tour_guide_id" id="tour_guide_id" class="form-select" required>
                            @foreach ($guides as $guide)
                                <option value="{{ $guide->id }}" @selected($tourSchedule->tour_guide_id === $guide->id)>
                                    {{ $guide->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" required placeholder="e.g. Everyone arrived on time, group is in great spirits."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection