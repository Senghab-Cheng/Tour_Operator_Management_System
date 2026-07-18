@extends('layouts.front')

@section('title', 'Destination')

@section('content')
<div class="container-fluid position-relative p-0">
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Destination</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Destination</h6>
            <h1 class="mb-5">Popular Destination</h1>
        </div>

        @if ($destinations->count() >= 4)
            @php
                $featured = $destinations->take(4);
            @endphp
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            @include('partials.destination-card', ['destination' => $featured[0], 'class' => ''])
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            @include('partials.destination-card', ['destination' => $featured[1], 'class' => ''])
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            @include('partials.destination-card', ['destination' => $featured[2], 'class' => ''])
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    @include('partials.destination-card', ['destination' => $featured[3], 'class' => 'h-100', 'tall' => true])
                </div>
            </div>
            @if ($destinations->count() > 4)
                <div class="row g-3 mt-2">
                    @foreach ($destinations->slice(4) as $destination)
                        <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                            @include('partials.destination-card', ['destination' => $destination, 'class' => ''])
                        </div>
                    @endforeach
                </div>
            @endif
        @elseif ($destinations->isNotEmpty())
            <div class="row g-3">
                @foreach ($destinations as $destination)
                    <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                        @include('partials.destination-card', ['destination' => $destination, 'class' => ''])
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <p class="text-muted mb-0">No destinations have been added yet. Check back soon.</p>
            </div>
        @endif
    </div>
</div>
@endsection
