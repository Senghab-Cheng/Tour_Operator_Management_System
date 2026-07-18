@extends('layouts.front')

@section('title', 'Manage Bookings')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Bookings</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-3 mb-4">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-2 align-items-center">
                <div class="col-auto">
                    <label for="status" class="col-form-label">Filter by status</label>
                </div>
                <div class="col-auto">
                    <select name="status" id="status" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (['pending', 'confirmed', 'cancelled', 'completed'] as $option)
                            <option value="{{ $option }}" @selected(request('status') === $option)>
                                {{ ucfirst($option) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if (request()->filled('status'))
                    <div class="col-auto">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
                    </div>
                @endif
            </form>
        </div>

        <div class="card">
            <div class="list-group list-group-flush">
                @forelse ($bookings as $booking)
                    <div class="list-group-item p-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <small class="text-muted">{{ $booking->booking_code }}</small>
                                <h4 class="h6 mb-0">{{ $booking->tourSchedule->tourPackage->title }}</h4>
                                <small class="text-muted">
                                    {{ $booking->tourSchedule->departure_date->format('M j, Y') }} ·
                                    {{ $booking->number_of_people }} {{ Str::plural('person', $booking->number_of_people) }} ·
                                    ${{ number_format($booking->total_price, 2) }}
                                </small>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <span class="badge {{ $booking->status === 'pending' ? 'bg-warning' : ($booking->status === 'confirmed' ? 'bg-success' : ($booking->status === 'completed' ? 'bg-primary' : 'bg-secondary')) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>

                                <form method="POST" action="{{ route('admin.bookings.status', $booking) }}"
                                      class="d-flex align-items-center gap-2"
                                      onsubmit="return confirm('Change status of {{ $booking->booking_code }} to ' + this.status.value + '?');">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-control form-control-sm">
                                        @foreach (['pending', 'confirmed', 'completed'] as $option)
                                            <option value="{{ $option }}" @selected($booking->status === $option)>
                                                {{ ucfirst($option) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>

                                @if (! in_array($booking->status, ['cancelled', 'completed']))
                                    <form method="POST" action="{{ route('admin.bookings.status', $booking) }}"
                                          onsubmit="return confirm('Cancel booking {{ $booking->booking_code }}?');">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-muted">No bookings found.</div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $bookings->appends(request()->query())->links() }}
        </div>
    </div>
@endsection