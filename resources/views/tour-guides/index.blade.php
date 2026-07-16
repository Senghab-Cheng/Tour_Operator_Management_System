@extends('layouts.front')

@section('title', 'Our Tour Guides')

@section('content')
<div class="container-fluid bg-primary py-5 mb-5">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="text-white mb-2">Meet Our Tour Guides</h1>
                <p class="text-white-50 mb-0">Experienced locals ready to show you around.</p>
                @auth
                    @if (Auth::user()->isStaff())
                        <a href="{{ route('admin.tour-guides.create') }}" class="btn btn-light rounded-pill px-4 mt-3">
                            <i class="fa fa-plus me-2"></i>Add Guide
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<div class="container py-2 mb-5">
    <div class="row g-4">
        @forelse ($guides as $guide)
            <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <img src="{{ $guide->photo ? asset($guide->photo) : asset('img/about.jpg') }}"
                         class="card-img-top rounded-circle mx-auto mt-4" style="width: 130px; height: 130px; object-fit: cover;"
                         alt="{{ $guide->name }}">
                    <div class="card-body">
                        <h5 class="card-title mb-2">{{ $guide->name }}</h5>
                        <div class="mb-3">
                            @foreach ($guide->skillList() as $skill)
                                <span class="badge bg-light text-dark border me-1 mb-1">{{ $skill }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('tour-guides.show', $guide) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">View Profile</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">No tour guides listed yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{ $guides->links() }}
    </div>
</div>
@endsection