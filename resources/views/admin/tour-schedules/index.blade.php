@extends('layouts.front')

@section('title', 'Manage Tour Schedules')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Tour Schedules</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-4 mb-4">
            <h3 class="h5 mb-3">Add Departure</h3>
            <form method="POST" action="{{ route('admin.tour-schedules.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <select name="tour_package_id" class="form-control" required>
                        <option value="">Choose tour</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"><input name="departure_date" type="date" class="form-control" required></div>
                <div class="col-md-4"><input name="max_seats" type="number" min="1" class="form-control" placeholder="Max seats" required></div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Save Departure</button></div>
            </form>
        </div>

        <div class="card">
            <div class="list-group list-group-flush">
                @forelse ($schedules as $schedule)
                    <div class="list-group-item p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="h6 mb-0">{{ $schedule->tourPackage->title }}</h4>
                                <small class="text-muted">
                                    {{ $schedule->departure_date->format('M j, Y') }} ·
                                    {{ $schedule->seats_booked }}/{{ $schedule->max_seats }} booked ·
                                    {{ $schedule->status }}
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.trips.show', $schedule) }}" class="btn btn-sm btn-outline-info">Manage Trip</a>
                                <details>
                                    <summary class="btn btn-sm btn-outline-primary">Edit</summary>
                                    <div class="mt-3">
                                        <form method="POST" action="{{ route('admin.tour-schedules.update', $schedule) }}" class="row g-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-6"><input name="departure_date" value="{{ $schedule->departure_date->format('Y-m-d') }}" type="date" class="form-control form-control-sm" required></div>
                                            <div class="col-md-6"><input name="max_seats" value="{{ $schedule->max_seats }}" type="number" min="{{ $schedule->seats_booked }}" class="form-control form-control-sm" required></div>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.tour-schedules.destroy', $schedule) }}" class="mt-2" onsubmit="return confirm('Delete this schedule?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-muted">No departures have been scheduled yet.</div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $schedules->links() }}
        </div>
    </div>
@endsection
