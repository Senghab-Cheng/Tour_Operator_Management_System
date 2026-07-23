@extends('layouts.front')

@section('title', 'Payment - ' . $booking->booking_code)

@section('content')
<div class="container py-5" style="max-width: 640px;">
    <h2 class="mb-1">Complete Your Payment</h2>
    <p class="text-muted mb-4">Booking {{ $booking->booking_code }}</p>

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

    <div class="card mb-4">
        <div class="card-body">
            <h3 class="h6 mb-3">Trip summary</h3>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Tour</span>
                <span>{{ $booking->tourSchedule->tourPackage->title }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Departure</span>
                <span>{{ $booking->tourSchedule->departure_date->format('D, M j Y') }}</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-muted">Travelers</span>
                <span>{{ $booking->number_of_people }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total due</span>
                <span>${{ number_format($booking->total_price, 2) }}</span>
            </div>
        </div>
    </div>

    @if (! $booking->payment)
        {{-- Step 1: choose a payment method --}}
        <div class="card">
            <div class="card-body">
                <h3 class="h6 mb-3">Choose a payment method</h3>
                <form method="POST" action="{{ route('bookings.payment.store', $booking) }}">
                    @csrf
                    <div class="list-group mb-3">
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input" type="radio" name="method" value="aba" checked required>
                            <span>
                                <strong>ABA</strong>
                                <div class="text-muted small">Scan the QR code or use the payment link.</div>
                            </span>
                        </label>
                        <label class="list-group-item d-flex gap-2">
                            <input class="form-check-input" type="radio" name="method" value="cash" required>
                            <span>
                                <strong>Cash</strong>
                                <div class="text-muted small">Pay in person at pickup.</div>
                            </span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill w-100">Continue</button>
                </form>
            </div>
        </div>
    @else
        {{-- Step 2: show status / QR for the chosen method --}}
        <div class="card">
            <div class="card-body text-center">
                <span class="badge {{ $booking->payment->status === 'paid' ? 'bg-success' : 'bg-warning' }} mb-3">
                    {{ ucfirst($booking->payment->status) }}
                </span>

                @if ($booking->payment->method === 'aba' && $booking->payment->status === 'pending')
                    <p class="mb-3">Pay <strong>${{ number_format($booking->total_price, 2) }}</strong> via ABA.</p>

                    @if (config('khqr.qr_image'))
                        <img src="{{ asset(config('khqr.qr_image')) }}" alt="ABA QR" style="width: 220px; height: 220px; object-fit: contain;" class="mb-3">
                    @endif

                    @if (config('khqr.link'))
                        <div class="mb-3">
                            <a href="{{ config('khqr.link') }}" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill">Pay via link</a>
                        </div>
                    @endif

                    @if (! config('khqr.qr_image') && ! config('khqr.link'))
                        <p class="text-muted small">Please contact our staff to arrange payment, quoting booking {{ $booking->booking_code }}.</p>
                    @endif

                    <p class="text-muted small mb-0">Reference: {{ $booking->booking_code }}</p>
                    <p class="text-muted small">Your booking will be confirmed once our staff verifies the payment.</p>
                @elseif ($booking->payment->method === 'cash')
                    <p class="mb-0">Please bring <strong>${{ number_format($booking->total_price, 2) }}</strong> in cash to your pickup point on the day of departure.</p>
                @endif

                @if ($booking->payment->status === 'paid')
                    <p class="text-success mb-0 mt-3">Payment confirmed &mdash; your booking is confirmed!</p>
                @endif
            </div>
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('bookings.index') }}" class="text-muted">&larr; Back to my bookings</a>
    </div>
</div>
@endsection