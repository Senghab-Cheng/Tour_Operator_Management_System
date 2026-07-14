@extends('layouts.app')

@section('content')


<!-- Hero Header -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">

    <div class="container py-5">

        <div class="row justify-content-center py-5">

            <div class="col-lg-10 text-center">

                <h1 class="display-3 text-white animated slideInDown">
                    Travel Guides
                </h1>

                <p class="text-white">
                    Explore destinations with experienced local guides
                </p>

            </div>

        </div>

    </div>

</div>



<!-- Travel Guides Start -->

<div class="container-xxl py-5">

    <div class="container">


        <div class="text-center wow fadeInUp">

            <h6 class="section-title bg-white text-center text-primary px-3">
                Guides
            </h6>

            <h1 class="mb-5">
                Our Travel Guides
            </h1>

        </div>



        <div class="row g-4">



            <!-- Guide 1 -->
            <div class="col-lg-4 col-md-6">

                <div class="service-item rounded overflow-hidden">


                    <img src="{{ asset('img/guide-1.png') }}"
                         class="img-fluid w-100"
                         style="height:250px; object-fit:cover;">


                    <div class="p-4">


                        <h4 class="mb-3">
                            Mei Mei
                        </h4>


                        <p>
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>
                            Beijing, China
                        </p>


                        <p>
                            Experienced car
                        </p>

                        <a href="{{ route('guide.1') }}"
                            class="btn btn-primary rounded-pill px-4">
                             See More Details
                        </a>


                    </div>


                </div>

            </div>

            <!-- Guide 2 -->
            <div class="col-lg-4 col-md-6">

                <div class="service-item rounded overflow-hidden">


                    <img src="{{ asset('img/guide-2.png') }}"
                         class="img-fluid w-100"
                         style="height:250px; object-fit:cover;">
                    <div class="p-4">
                        <h4 class="mb-3">
                            Speed
                        </h4>
                        <p>
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>
                            Los Angelas, USA
                        </p>

                        <p>
                            A professional guide trying not to laugh? (That's disrespectful ash)
                        </p>
                        <a href="{{ route('guide.2') }}"
                            class="btn btn-primary rounded-pill px-4">
                            See More Details
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-item rounded overflow-hidden">
                    <img src="{{ asset('img/guide-3.png') }}"
                         class="img-fluid w-100"
                         style="height:250px; object-fit:cover;">

                    <div class="p-4">
                        <h4 class="mb-3">
                            Hachiware
                        </h4>
                        <p>
                            <i class="fa fa-map-marker-alt text-primary me-2"></i>
                            Tokyo, Japan
                        </p>

                        <p>
                            Local expert specializing in weed pulling. Very studious.
                        </p>

                       <a href="{{ route('guide.3') }}"
                            class="btn btn-primary rounded-pill px-4">
                            See More Details
                        </a>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Travel Guides End -->


@endsection