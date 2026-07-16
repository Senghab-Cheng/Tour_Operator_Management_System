@extends('layouts.app')

@section('title', 'Mei Mei')

@section('content')


<!-- Page Title -->
<div class="container-fluid py-5 mb-5">

    <div class="container py-5">

        <div class="text-center">

            <h1 class="display-3 text-primary">
               Mei Mei
            </h1>

            <p class="fs-4 text-dark">
                Professional car
            </p>

            <a href="{{ route('travel.guides') }}"
               class="btn btn-primary rounded-pill py-2 px-4 mt-3">

                <i class="fa fa-arrow-left me-2"></i>
                Back to Travel Guides

            </a>
        </div>

    </div>

</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <img src="{{ asset('img/guide-1.png') }}"
                 class="img-fluid rounded"
                 style="height:450px; width:100%; object-fit:cover;">

        </div>

        <div class="col-lg-7">
            <h1>
                Mei Mei
            </h1>
            <p>
                A local car specializing in culture,
                temples, food experiences and hidden destinations.
            </p>

            <p>
                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                Beijing, China
            </p>


            <p>
                <i class="fa fa-briefcase text-primary me-2"></i>
                Experience: 11 Years
            </p>


            <p>
                <i class="fa fa-language text-primary me-2"></i>
                Languages: Chinese, Japanese, English
            </p>


            <p>
                <i class="fa fa-star text-primary me-2"></i>
                Rating: 6 / 5
            </p>


            <p>
                <i class="fa fa-users text-primary me-2"></i>
                Completed Tours: 120+
            </p>


            <a href="{{ route('booking.form') }}"
               class="btn btn-primary rounded-pill py-3 px-5">

                Book Tour

            </a>


        </div>


    </div>

</div>


@endsection