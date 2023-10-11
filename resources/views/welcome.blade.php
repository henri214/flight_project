@extends('layouts.app')
@section('content')
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h1>Book your ideal Flights</h1>
                    <p class="lead">This is where our catchy phrase should come! </p>
                    <p class="lead">Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. </p>
                    <p class="lead">Lorem Ipsum dolor sit amet. Lorem Ipsum dolor sit amet. </p>
                    <p><a href="#" class="btn btn-primary shadow mr-2">Learn More</a><a href="#"
                            class="btn btn-outline-primary">Start Booking</a></p>
                </div>
                <div class="col-lg-6 order-1 order-lg-2"><img src="{{ asset('images/nature.png') }}" alt="landing image"
                        class="img-fluid"></div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section>
        <div class="container">
            <h2>What We Do?</h2>
            <p class="text-muted mb-5">A sub-heading should come here :)</p>
            <div class="row">
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-heart"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-inbox"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-rocket"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-inbox"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-rocket"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <svg class="lnr text-primary services-icon">
                        <use xlink:href="#lnr-heart"></use>
                    </svg>
                    <h6>Tempor aute occaecat</h6>
                    <p class="text-muted">Tempor aute occaecat pariatur esse aute amet.</p>
                </div>
            </div>
        </div>
    </section>
    
@endsection
