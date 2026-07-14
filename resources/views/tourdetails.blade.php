@extends('layouts.app')

@section('title', 'Tour Details')

@section('content')


<!-- Hero Header -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-10 text-center">

                <h1 class="display-3 text-white">
                    Cambodia Adventure Tour
                </h1>

                <p class="text-white">
                    Explore amazing destinations with our guided tours
                </p>

            </div>

        </div>

    </div>

</div>



<!-- Tour Details -->

<div class="container py-5">

    <div class="row g-5">


        <!-- Image -->

        <div class="col-lg-6">

            <img src="{{ asset('img/destination-2.jpg') }}"
                 class="img-fluid rounded"
                 style="height:400px; width:100%; object-fit:cover;">

        </div>



        <!-- Information -->

        <div class="col-lg-6">


            <h1 class="mb-4">
                Cambodia Cultural Adventure
            </h1>


            <p>
                Discover ancient temples, beautiful landscapes,
                and local culture with our professional tour guides.
            </p>



            <div class="mb-3">

                <p>
                    <i class="fa fa-calendar text-primary me-2"></i>
                    <b>Trip Date:</b>
                    15 August 2026 - 20 August 2026
                </p>


                <p>
                    <i class="fa fa-clock text-primary me-2"></i>
                    <b>Duration:</b>
                    6 Days / 5 Nights
                </p>


                <p>
                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                    <b>Location:</b>
                    Cambodia
                </p>


                <p>
                    <i class="fa fa-dollar-sign text-primary me-2"></i>
                    <b>Price:</b>
                    $500 per person
                </p>


                <p>
                    <i class="fa fa-users text-primary me-2"></i>
                    <b>Maximum Participants:</b>
                    30 People
                </p>


                <p>
                    <i class="fa fa-user-check text-primary me-2"></i>
                    <b>Currently Booked:</b>
                    18 People
                </p>


            </div>



            <a href="{{ route('booking.form') }}"
               class="btn btn-primary rounded-pill py-3 px-5">

                Book Now

            </a>


        </div>


    </div>

</div>





<!-- Itinerary -->

<div class="container py-5">

    <div class="text-center">

        <h6 class="section-title bg-white text-center text-primary px-3">
            Details
        </h6>

        <h1 class="mb-5">
            Tour Information
        </h1>

    </div>



    <div class="row g-4">


        <div class="col-lg-4">

            <div class="service-item rounded p-4">

                <h4>
                    Included
                </h4>

                <p>
                    ✔ Hotel accommodation<br>
                    ✔ Transportation<br>
                    ✔ Professional guide<br>
                    ✔ Breakfast and dinner
                </p>

            </div>

        </div>



        <div class="col-lg-4">

            <div class="service-item rounded p-4">

                <h4>
                    Not Included
                </h4>

                <p>
                    ✘ Flight tickets<br>
                    ✘ Personal expenses<br>
                    ✘ Travel insurance
                </p>

            </div>

        </div>




        <div class="col-lg-4">

            <div class="service-item rounded p-4">

                <h4>
                    Schedule
                </h4>

                <p>
                    Day 1: Arrival<br>
                    Day 2-4: Tours<br>
                    Day 5: Activities<br>
                    Day 6: Departure
                </p>

            </div>

        </div>


    </div>


</div>


@endsection