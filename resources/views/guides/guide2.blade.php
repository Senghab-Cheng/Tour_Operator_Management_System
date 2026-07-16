@extends('layouts.app')

@section('title', 'Speed')

@section('content')

<!-- Page Title -->
<div class="container-fluid py-5 mb-5">

    <div class="container py-5">

        <div class="text-center">

            <h1 class="display-3 text-primary">
                Speed
            </h1>

            <p class="fs-4 text-dark">
                A professional guide trying not to laugh? (That's disrespectful ash)
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

            <img src="{{ asset('img/guide-2.png') }}"
                 class="img-fluid rounded"
                 style="height:450px; width:100%; object-fit:cover;">

        </div>

        <div class="col-lg-7">

            <h1>
                Speed
            </h1>


            <p>
                A local guide specializing in fortnite,
                cross-country streaming, and fried chicken (watermelon sometimes).
            </p>



            <p>
                <i class="fa fa-map-marker-alt text-primary me-2"></i>
                Los Angelas, USA
            </p>


            <p>
                <i class="fa fa-briefcase text-primary me-2"></i>
                Experience: 8 Years
            </p>


            <p>
                <i class="fa fa-language text-primary me-2"></i>
                Languages: English
            </p>


            <p>
                <i class="fa fa-star text-primary me-2"></i>
                Rating: 1 / 5
            </p>


            <p>
                <i class="fa fa-users text-primary me-2"></i>
                Completed Tours: 67
            </p>


            <a href="{{ route('booking.form') }}"
               class="btn btn-primary rounded-pill py-3 px-5">

                Book Tour

            </a>


        </div>


    </div>

</div>


@endsection