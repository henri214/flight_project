@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Flight Detail</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Price</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $flight->price }}
                                            $</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Country Name</span>
                                        <span class="info-box-number text-center text-muted mb-0">{{ $flight->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Country To</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $flight->country_to }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Pasangers</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $flight->pasangers }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Airline</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $flight->airline->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Departure Time</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $flight->departure_time }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-3">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Arrival Time</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $flight->arrival_time }}</span>
                                    </div>
                                </div>
                            </div>
                            @if ($flight->two_way)
                                <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Second Flight Depature
                                                Time</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $flight->two_way_departure_time }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Second Flight Arrival
                                                Time</span>
                                            <span
                                                class="info-box-number text-center text-muted mb-0">{{ $flight->two_way_arrival_time }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if (session()->has('error'))
                        <div class="alert alert-success">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <h4>Book</h4>
                <a href="{{ route('processTransaction', $flight) }}"
                    class="w-full  uppercase rounded-xl font-extrabold text-black px-6 h-8">Pay with
                    PayPal👉</a>
            </div>
        </div>
    </section>
@endsection
