@extends('layouts.front')

@section('title', 'Manage Vehicles')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Vehicles</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-4 mb-4">
            <h3 class="h5 mb-3">Add Vehicle</h3>
            <form method="POST" action="{{ route('admin.vehicles.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <select name="type" class="form-control" required>
                        <option value="tuktuk">Tuktuk</option>
                        <option value="car">Car</option>
                        <option value="van">Van</option>
                        <option value="bus">Bus</option>
                    </select>
                </div>
                <div class="col-md-4"><input name="plate_number" value="{{ old('plate_number') }}" class="form-control" placeholder="Plate number" required></div>
                <div class="col-md-4"><input name="capacity" value="{{ old('capacity') }}" type="number" min="1" class="form-control" placeholder="Capacity" required></div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Save Vehicle</button></div>
            </form>
        </div>

        <div class="card">
            <div class="list-group list-group-flush">
                @forelse ($vehicles as $vehicle)
                    <div class="list-group-item p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="h6 mb-0">{{ strtoupper($vehicle->plate_number) }}</h4>
                                <small class="text-muted">{{ ucfirst($vehicle->type) }} · {{ $vehicle->capacity }} seats · {{ $vehicle->status }}</small>
                            </div>
                            <details>
                                <summary class="btn btn-sm btn-outline-primary">Edit</summary>
                                <div class="mt-3">
                                    <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}" class="row g-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-6"><input name="plate_number" value="{{ $vehicle->plate_number }}" class="form-control form-control-sm" required></div>
                                        <div class="col-md-6"><input name="capacity" value="{{ $vehicle->capacity }}" type="number" min="1" class="form-control form-control-sm" required></div>
                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="mt-2" onsubmit="return confirm('Delete this vehicle?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </details>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-muted">No vehicles have been added yet.</div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    </div>
@endsection
