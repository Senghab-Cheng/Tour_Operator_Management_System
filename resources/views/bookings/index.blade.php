@extends('layouts.front')

@section('title', 'My Bookings')

@section('styles')
<style>
    .star-rating-input {
        display: inline-flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .star-rating-input input {
        display: none;
    }
    .star-rating-input label {
        cursor: pointer;
        font-size: 1.6rem;
        color: #e0e0e0;
        padding: 0 2px;
        transition: color 0.15s ease-in-out;
    }
    .star-rating-input input:checked ~ label,
    .star-rating-input label:hover,
    .star-rating-input label:hover ~ label {
        color: #ffc107;
    }
    .star-rating-display {
        color: #ffc107;
        letter-spacing: 2px;
    }
</style>
@endsection

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

                                @if ($booking->status === 'pending')
                                    <div class="mt-2">
                                        <a href="{{ route('bookings.payment.show', $booking) }}" class="btn btn-sm btn-primary">
                                            {{ $booking->payment ? 'View payment' : 'Complete payment' }}
                                        </a>
                                    </div>
                                @endif

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

                        @if ($booking->status !== 'cancelled')
                            <div class="mt-3 pt-3 border-top">
                                @if ($booking->review)
                                    {{-- Feedback already submitted for this trip --}}
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <span class="star-rating-display">{{ str_repeat('★', $booking->review->rating) }}{{ str_repeat('☆', 5 - $booking->review->rating) }}</span>
                                            @if ($booking->review->comment)
                                                <p class="mb-0 text-muted mt-1">{{ $booking->review->comment }}</p>
                                            @endif
                                        </div>
                                        <form method="POST" action="{{ route('reviews.destroy', $booking->review) }}"
                                              onsubmit="return confirm('Delete your review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete review</button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Feedback form: let the user rate and comment on this completed trip --}}
                                    <button class="btn btn-sm btn-primary rounded-pill" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#review-form-{{ $booking->id }}">
                                        Leave a review
                                    </button>

                                    <div class="collapse mt-3" id="review-form-{{ $booking->id }}">
                                        <form method="POST" action="{{ route('reviews.store') }}">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                            <div class="mb-2">
                                                <label class="form-label d-block mb-1">Your rating</label>
                                                <div class="star-rating-input">
                                                    @for ($i = 5; $i >= 1; $i--)
                                                        <input type="radio" name="rating" id="rating-{{ $booking->id }}-{{ $i }}" value="{{ $i }}" required>
                                                        <label for="rating-{{ $booking->id }}-{{ $i }}"><i class="fa fa-star"></i></label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <div class="mb-2">
                                                <label for="comment-{{ $booking->id }}" class="form-label">Comment (optional)</label>
                                                <textarea name="comment" id="comment-{{ $booking->id }}" class="form-control"
                                                          rows="3" maxlength="2000" placeholder="How was your trip?"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-success rounded-pill">Submit feedback</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endif
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