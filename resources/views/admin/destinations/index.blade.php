@extends('layouts.front')

@section('title', 'Manage Destinations')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Destinations</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-4 mb-4">
            <h3 class="h5 mb-3">Add Destination</h3>
            <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Place name</label>
                    <input name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Siem Reap" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Discount label</label>
                    <input name="discount" value="{{ old('discount') }}" class="form-control" placeholder="e.g. 30% OFF">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Destination image</label>
                    <input name="image" type="file" accept="image/*" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Or image path</label>
                    <input name="image_path" value="{{ old('image_path') }}" class="form-control" placeholder="e.g. img/destination-1.jpg">
                </div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Save Destination</button></div>
            </form>
        </div>

        <div class="row g-4">
            @forelse ($destinations as $destination)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ $destination->image_path ? asset($destination->image_path) : asset('img/destination-1.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $destination->name }}">
                        <div class="card-body">
                            <h4 class="h5">{{ $destination->name }}</h4>
                            @if ($destination->discount)
                                <span class="badge bg-danger mb-3">{{ $destination->discount }}</span>
                            @endif

                            <details>
                                <summary class="btn btn-sm btn-outline-primary mb-3">Edit Destination</summary>
                                <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data" class="row g-2">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-12"><input name="name" value="{{ old('name', $destination->name) }}" class="form-control form-control-sm" required></div>
                                    <div class="col-12"><input name="discount" value="{{ old('discount', $destination->discount) }}" class="form-control form-control-sm" placeholder="Discount"></div>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                                <form method="POST" action="{{ route('admin.destinations.destroy', $destination) }}" class="mt-2" onsubmit="return confirm('Delete this destination?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </details>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No destinations have been added yet.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $destinations->links() }}
        </div>
    </div>
@endsection
