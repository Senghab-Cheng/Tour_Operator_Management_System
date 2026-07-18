@extends('layouts.front')

@section('title', 'Manage Tour Guides')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Manage Tour Guides</h2>

        @include('admin.partials.nav')
        @include('admin.partials.alerts')

        <div class="card p-4 mb-4">
            <h3 class="h5 mb-3">Add Tour Guide</h3>
            <form method="POST" action="{{ route('admin.tour-guides.store') }}" enctype="multipart/form-data" class="row g-3">
                @csrf
                <div class="col-md-6"><input name="name" value="{{ old('name') }}" class="form-control" placeholder="Guide name" required></div>
                <div class="col-md-6"><input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="Email"></div>
                <div class="col-md-6"><input name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Phone"></div>
                <div class="col-md-6"><input name="skills" value="{{ old('skills') }}" class="form-control" placeholder="Skills, comma separated"></div>
                <div class="col-md-12">
                    <label class="form-label">Profile photo</label>
                    <input name="photo" type="file" accept="image/*" class="form-control">
                </div>
                <div class="col-md-12">
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-md-12"><input name="photo_path" value="{{ old('photo_path') }}" class="form-control" placeholder="Or image path, e.g. img/about.jpg"></div>
                <div class="col-md-12"><textarea name="bio" class="form-control" rows="4" placeholder="Bio">{{ old('bio') }}</textarea></div>
                <div class="col-md-12"><button type="submit" class="btn btn-primary">Save Guide</button></div>
            </form>
        </div>

        <div class="row g-4">
            @forelse ($guides as $guide)
                <div class="col-md-4">
                    <div class="card h-100 p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ $guide->photo ? asset($guide->photo) : asset('img/about.jpg') }}" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;" alt="{{ $guide->name }}">
                            <div>
                                <h4 class="h6 mb-0">{{ $guide->name }}</h4>
                                <small class="text-muted">{{ $guide->status }} · {{ $guide->tour_schedules_count }} trips</small>
                            </div>
                        </div>

                        <details>
                            <summary class="btn btn-sm btn-outline-primary mb-3">Edit Guide</summary>
                            <form method="POST" action="{{ route('admin.tour-guides.update', $guide) }}" enctype="multipart/form-data" class="row g-2">
                                @csrf
                                @method('PUT')
                                <div class="col-12"><input name="name" value="{{ old('name', $guide->name) }}" class="form-control form-control-sm" required></div>
                                <div class="col-12"><input name="email" value="{{ old('email', $guide->email) }}" type="email" class="form-control form-control-sm" placeholder="Email"></div>
                                <button type="submit" class="btn btn-sm btn-primary">Update Guide</button>
                            </form>
                            <form method="POST" action="{{ route('admin.tour-guides.destroy', $guide) }}" class="mt-2" onsubmit="return confirm('Delete this guide?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete Guide</button>
                            </form>
                        </details>
                    </div>
                </div>
            @empty
                <p class="text-muted">No guides have been added yet.</p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $guides->links() }}
        </div>
    </div>
@endsection
