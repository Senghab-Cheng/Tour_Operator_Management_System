<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Vehicles</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('admin.partials.nav')
            @include('admin.partials.alerts')

            <section class="admin-card p-6">
                <h3 class="admin-section-title">Add Vehicle</h3>
                <form method="POST" action="{{ route('admin.vehicles.store') }}" class="grid md:grid-cols-3 gap-4">
                    @csrf
                    <select name="type" class="admin-input" required>
                        <option value="tuktuk">Tuktuk</option>
                        <option value="car">Car</option>
                        <option value="van">Van</option>
                        <option value="bus">Bus</option>
                    </select>
                    <input name="plate_number" value="{{ old('plate_number') }}" class="admin-input" placeholder="Plate number" required>
                    <input name="capacity" value="{{ old('capacity') }}" type="number" min="1" class="admin-input" placeholder="Capacity" required>
                    <input name="driver_name" value="{{ old('driver_name') }}" class="admin-input" placeholder="Driver name">
                    <input name="driver_phone" value="{{ old('driver_phone') }}" class="admin-input" placeholder="Driver phone">
                    <select name="status" class="admin-input">
                        <option value="available">Available</option>
                        <option value="in_use">In use</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <div class="md:col-span-3">
                        <button type="submit" class="admin-btn-primary">Save Vehicle</button>
                    </div>
                </form>
            </section>

            <section class="admin-card overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @forelse ($vehicles as $vehicle)
                        <details class="p-5">
                            <summary class="cursor-pointer list-none flex justify-between gap-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ strtoupper($vehicle->plate_number) }}</h4>
                                    <p class="text-sm text-gray-500">{{ ucfirst($vehicle->type) }} · {{ $vehicle->capacity }} seats · {{ $vehicle->status }}</p>
                                </div>
                                <span class="admin-summary">Edit Vehicle</span>
                            </summary>
                            <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}" class="mt-4 grid md:grid-cols-3 gap-3">
                                @csrf
                                @method('PUT')
                                <select name="type" class="admin-input" required>
                                    @foreach (['tuktuk', 'car', 'van', 'bus'] as $type)
                                        <option value="{{ $type }}" @selected($vehicle->type === $type)>{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                                <input name="plate_number" value="{{ $vehicle->plate_number }}" class="admin-input" required>
                                <input name="capacity" value="{{ $vehicle->capacity }}" type="number" min="1" class="admin-input" required>
                                <input name="driver_name" value="{{ $vehicle->driver_name }}" class="admin-input" placeholder="Driver name">
                                <input name="driver_phone" value="{{ $vehicle->driver_phone }}" class="admin-input" placeholder="Driver phone">
                                <select name="status" class="admin-input">
                                    @foreach (['available', 'in_use', 'maintenance'] as $status)
                                        <option value="{{ $status }}" @selected($vehicle->status === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                                    @endforeach
                                </select>
                                <div class="md:col-span-3">
                                    <button type="submit" class="admin-btn-primary">Update Vehicle</button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="mt-3" onsubmit="return confirm('Delete this vehicle?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete Vehicle</button>
                            </form>
                        </details>
                    @empty
                        <p class="p-6 text-gray-500">No vehicles have been added yet.</p>
                    @endforelse
                </div>
            </section>

            {{ $vehicles->links() }}
        </div>
    </div>
</x-app-layout>
