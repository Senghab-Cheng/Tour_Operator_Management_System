<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Tour Schedules</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('admin.partials.nav')
            @include('admin.partials.alerts')

            <section class="admin-card p-6">
                <h3 class="admin-section-title">Add Departure</h3>
                <form method="POST" action="{{ route('admin.tour-schedules.store') }}" class="grid md:grid-cols-3 gap-4">
                    @csrf
                    <select name="tour_package_id" class="admin-input" required>
                        <option value="">Choose tour</option>
                        @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->title }}</option>
                        @endforeach
                    </select>
                    <select name="tour_guide_id" class="admin-input">
                        <option value="">No guide yet</option>
                        @foreach ($guides as $guide)
                            <option value="{{ $guide->id }}">{{ $guide->name }}</option>
                        @endforeach
                    </select>
                    <select name="vehicle_id" class="admin-input">
                        <option value="">No vehicle yet</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ strtoupper($vehicle->plate_number) }} · {{ ucfirst($vehicle->type) }}</option>
                        @endforeach
                    </select>
                    <input name="departure_date" type="date" class="admin-input" required>
                    <input name="pickup_point" class="admin-input" placeholder="Pickup point">
                    <input name="pickup_time" type="time" class="admin-input">
                    <input name="max_seats" type="number" min="1" class="admin-input" placeholder="Max seats" required>
                    <select name="status" class="admin-input">
                        <option value="scheduled">Scheduled</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    <div class="md:col-span-3">
                        <button type="submit" class="admin-btn-primary">Save Departure</button>
                    </div>
                </form>
            </section>

            <section class="admin-card overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @forelse ($schedules as $schedule)
                        <details class="p-5">
                            <summary class="cursor-pointer list-none flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $schedule->tourPackage->title }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $schedule->departure_date->format('M j, Y') }} ·
                                        {{ $schedule->seats_booked }}/{{ $schedule->max_seats }} booked ·
                                        {{ $schedule->status }}
                                    </p>
                                </div>
                                <span class="admin-summary">Edit Departure</span>
                            </summary>
                            <form method="POST" action="{{ route('admin.tour-schedules.update', $schedule) }}" class="mt-4 grid md:grid-cols-3 gap-3">
                                @csrf
                                @method('PUT')
                                <select name="tour_guide_id" class="admin-input">
                                    <option value="">No guide</option>
                                    @foreach ($guides as $guide)
                                        <option value="{{ $guide->id }}" @selected($schedule->tour_guide_id === $guide->id)>{{ $guide->name }}</option>
                                    @endforeach
                                </select>
                                <select name="vehicle_id" class="admin-input">
                                    <option value="">No vehicle</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" @selected($schedule->vehicle_id === $vehicle->id)>{{ strtoupper($vehicle->plate_number) }} · {{ ucfirst($vehicle->type) }}</option>
                                    @endforeach
                                </select>
                                <input name="departure_date" value="{{ $schedule->departure_date->format('Y-m-d') }}" type="date" class="admin-input" required>
                                <input name="pickup_point" value="{{ $schedule->pickup_point }}" class="admin-input" placeholder="Pickup point">
                                <input name="pickup_time" value="{{ $schedule->pickup_time ? \Carbon\Carbon::parse($schedule->pickup_time)->format('H:i') : '' }}" type="time" class="admin-input">
                                <input name="max_seats" value="{{ $schedule->max_seats }}" type="number" min="{{ $schedule->seats_booked }}" class="admin-input" required>
                                <select name="status" class="admin-input">
                                    @foreach (['scheduled', 'ongoing', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" @selected($schedule->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <div class="md:col-span-3">
                                    <button type="submit" class="admin-btn-primary">Update Departure</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('admin.tour-schedules.destroy', $schedule) }}" class="mt-3" onsubmit="return confirm('Delete this schedule?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete Schedule</button>
                            </form>
                        </details>
                    @empty
                        <p class="p-6 text-gray-500">No departures have been scheduled yet.</p>
                    @endforelse
                </div>
            </section>

            {{ $schedules->links() }}
        </div>
    </div>
</x-app-layout>
