@extends('layouts.front')

@section('title', 'About')

@section('content')
<div class="container-fluid position-relative p-0">
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row justify-content-center py-5">
                    <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                        <h1 class="display-3 text-white animated slideInDown">About Us</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- About Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height:400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100"
                        src="{{ asset('img/about.jpg') }}"
                        alt="About"
                        style="object-fit:cover;">
                </div>
            </div>

            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">

                <h6 class="section-title bg-white text-start text-primary pe-3">
                    About Us
                </h6>

                <h1 class="mb-4">
                    Welcome to Our Tour Agency
                </h1>

                <p class="mb-4">
                    We are a Cambodia-based tour operator sharing the culture, history, and natural beauty of our country with travelers from around the world.
                </p>

                <p class="mb-4">
                    Our guides grew up in the places we tour — from Angkor Wat at sunrise to the riverside markets of Phnom Penh. We handle transport, accommodation, and logistics so you can focus on the experience.
                </p>

                <div class="row gy-2 gx-4 mb-4">

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>Licensed Local Guides</p>
                    </div>

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>Handpicked Hotels</p>
                    </div>

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>Comfortable Accommodations</p>
                    </div>

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>Air-Conditioned Vehicles</p>
                    </div>

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>150+ Happy Travelers</p>
                    </div>

                    <div class="col-sm-6">
                        <p><i class="fa fa-arrow-right text-primary me-2"></i>24/7 Service</p>
                    </div>

                </div>

                <a href="#" class="btn btn-primary py-3 px-5 mt-2">
                    Read More
                </a>

            </div>

        </div>
    </div>
</div>
<!-- About End -->

@endsection