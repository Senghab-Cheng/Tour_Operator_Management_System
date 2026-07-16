@extends('layouts.app')

@section('content')

<!-- Hero Header -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">
                    Hotel Reservation
                </h1>
                <p class="text-white">
                    Find and reserve hotels around the world
                </p>
            </div>
        </div>
    </div>
</div>


<!-- Hotel Reservation Start -->
<form method="GET" action="{{ route('hotel.reservation') }}">

    <div class="row justify-content-center mb-5">

        <div class="col-lg-6">

            <label class="fw-bold mb-2">
                Select Country
            </label>

            <select name="country" 
                    class="form-select form-select-lg"
                    onchange="this.form.submit()">

                <option value="">
                    -- Select a country --
                </option>

                <option value="japan"
                    {{ request('country') == 'japan' ? 'selected' : '' }}>
                    Japan
                </option>

                <option value="france"
                    {{ request('country') == 'france' ? 'selected' : '' }}>
                    France
                </option>

                <option value="italy"
                    {{ request('country') == 'italy' ? 'selected' : '' }}>
                    Italy
                </option>

                <option value="cambodia"
                    {{ request('country') == 'cambodia' ? 'selected' : '' }}>
                    Cambodia
                </option>

            </select>

        </div>

    </div>

</form>

@php
$hotels = [

    'japan' => [
        [
            'name' => 'Tokyo Grand Hotel',
            'location' => 'Tokyo',
            'image' => '/img/hotel-1.png',
            'price' => '$150 / night'
        ],

        [
            'name' => 'Kyoto Palace Hotel',
            'location' => 'Kyoto',
            'image' => '/img/hotel-2.png',
            'price' => '$120 / night'
        ]
    ],

    'france' => [
        [
            'name' => 'Paris Luxury Hotel',
            'location' => 'Paris',
            'image' => '/img/hotel-3.png',
            'price' => '$200 / night'
        ]
    ],

    'italy' => [
        [
            'name' => 'Rome Heritage Hotel',
            'location' => 'Rome',
            'image' => '/img/hotel-1.png',
            'price' => '$170 / night'
        ]
    ],

    'cambodia' => [
        [
            'name' => 'Siem Reap Hotel',
            'location' => 'Siem Reap',
            'image' => '/img/hotel-2.png',
            'price' => '$90 / night'
        ]
    ]

];
$selectedCountry = request('country');
@endphp

<div class="row g-4">
@if($selectedCountry && isset($hotels[$selectedCountry]))
    @foreach($hotels[$selectedCountry] as $hotel)

    <div class="col-lg-4 col-md-6">
        <div class="service-item rounded overflow-hidden">

            <img src="{{ $hotel['image'] }}"
                 class="img-fluid w-100"
                 style="height:220px; object-fit:cover;">

            <div class="p-4">
                <h4 class="mb-3">
                    {{ $hotel['name'] }}
                </h4>

                <p>
                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                    {{ $hotel['location'] }}
                </p>

                <p class="fw-bold">
                    {{ $hotel['price'] }}
                </p>

                <a href="{{ route('booking.form') }}"
                   class="btn btn-primary rounded-pill px-4">
                    Book Now
                </a>
            </div>

        </div>
    </div>


    @endforeach


@elseif($selectedCountry)

    <h4 class="text-center">
        No hotels available
    </h4>

@endif


</div>


@endsection