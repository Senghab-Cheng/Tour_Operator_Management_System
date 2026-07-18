@extends('layouts.front')

@section('title', 'Manage Tours')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Tours</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-4 mb-4">
            <h3 class="h5 mb-3">Add Tour Package</h3>
            <form method="POST" action="{{ route('admin.tour-packages.store') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6"><input name="title" value="{{ old('title') }}" class="form-control" placeholder="Tour title" required></div>
                <div class="col-md-6"><input name="destination" value="{{ old('destination') }}" class="form-control" placeholder="Destination" required></div>
                <div class="col-md-12"><input name="price" value="{{ old('price') }}" type="number" min="0" step="0.01" class="form-control" placeholder="Price" required></div>
                <div class="col-md-6"><input name="duration_days" value="{{ old('duration_days') }}" type="number" min="1" class="form-control" placeholder="Days" required></div>
                <div class="col-md-6"><input name="duration_nights" value="{{ old('duration_nights') }}" type="number" min="0" class="form-control" placeholder="Nights" required></div>
                <div class="col-md-12"><input name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Custom slug (optional)"></div>
                <div class="col-md-12">
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Cover image</label>
                    <input name="cover_image" type="file" accept="image/*" class="form-control">
                </div>
                <div class="col-md-12"><input name="cover_image_path" value="{{ old('cover_image_path') }}" class="form-control" placeholder="Or image path, e.g. img/destination-1.jpg"></div>
                <div class="col-md-12"><textarea name="description" class="form-control" rows="4" placeholder="Tour details">{{ old('description') }}</textarea></div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Save Tour</button></div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="h5 mb-0">Tours From Database</h3>
            </div>

            <div class="list-group list-group-flush">
                @forelse ($packages as $package)
                    <div class="list-group-item p-4">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $package->cover_image ? asset($package->cover_image) : asset('img/destination-1.jpg') }}" class="rounded" style="width: 100px; height: 60px; object-fit: cover;" alt="{{ $package->title }}">
                            <div>
                                <h4 class="h6 mb-0">{{ $package->title }}</h4>
                                <small class="text-muted">{{ $package->destination }} · ${{ number_format($package->price, 2) }} · {{ $package->status }}</small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <form method="POST" action="{{ route('admin.tour-packages.update', $package) }}" enctype="multipart/form-data" class="row g-2">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4"><input name="title" value="{{ old('title', $package->title) }}" class="form-control" required></div>
                                <div class="col-md-4"><input name="destination" value="{{ old('destination', $package->destination) }}" class="form-control" required></div>
                                <div class="col-md-4"><input name="price" value="{{ old('price', $package->price) }}" type="number" min="0" step="0.01" class="form-control" required></div>
                                <button type="submit" class="btn btn-primary btn-sm">Update Tour</button>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('admin.tour-packages.destroy', $package) }}" class="mt-2" onsubmit="return confirm('Delete this tour package?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete Tour Package</button>
                        </form>
                    </div>
                @empty
                    <div class="p-4 text-muted">No tour packages have been added yet.</div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            {{ $packages->links() }}
        </div>
    </div>
@endsection
