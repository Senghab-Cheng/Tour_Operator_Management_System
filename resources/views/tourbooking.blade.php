@extends('layouts.app')

@section('title', 'Worldwide Tours')

@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-center py-5">
            <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Worldwide Tours</h1>
                <p class="fs-4 text-white mb-4 animated slideInDown">Explore handpicked destinations across the globe and book your next adventure</p>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Worldwide Tours</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Destinations Start -->
<div class="container-fluid py-5 destination">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Destinations</h6>
            <h1 class="mb-5">Choose Your Next Destination</h1>
        </div>
        <div class="row g-4">

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-2.jpg') }}" alt="Cambodia" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">30% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Cambodia</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('tour.details') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-2.jpg') }}" alt="Malaysia" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">25% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Malaysia</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('booking.form') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-3.jpg') }}" alt="Australia" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">35% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Australia</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('booking.form') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-4.jpg') }}" alt="Indonesia" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">20% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Indonesia</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('booking.form') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-2.jpg') }}" alt="Thailand" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">15% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Japan</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('booking.form') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/destination-3.jpg') }}" alt="Vietnam" style="height: 250px; object-fit: cover;">
                        <div class="bg-white text-danger fw-bold position-absolute top-0 start-0 m-3 py-1 px-2">40% OFF</div>
                    </div>
                    <div class="p-4 text-center">
                        <h5 class="mb-2">Vietnam</h5>
                        <p class="mb-3">Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>
                        <a href="{{ route('booking.form') }}" class="btn btn-primary rounded-pill py-2 px-4">Book Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Destinations End -->

@endsection