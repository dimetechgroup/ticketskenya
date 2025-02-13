@extends('layouts.guest')
@section('styles')
    <style>
        .whyChooseUs {
            background-image: url("/images/why-us-bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center bottom;
            padding: 80px 0;
            position: relative;
            color: #000;
        }

        .whyChooseUs h6 {
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .whyChooseUs h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .whyChooseUs p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            height: 300px;
            justify-content: end;

        }

        .card-blue {

            background-image: url("/images/icon-color-box-bg01.svg");
            background-repeat: no-repeat;
            background-size: contain;
            background-color: #007bff;
        }

        .card-green {
            background-image: url("/images/icon-color-box-bg01.svg");
            background-repeat: no-repeat;
            background-size: contain;
            background-color: #28a745;
        }

        .card-black {
            background-image: url("/images/icon-color-box-bg01.svg");
            background-repeat: no-repeat;
            background-size: contain;
            background-color: #333;
        }

        .card-custom h4 {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .card-custom p {
            font-size: 0.95rem;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="heroSection">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-7 text-white">
                    <h1 class="hero-title">Tickets Kenya</h1>
                    <p class="hero-subtitle">
                        Corporate event ticketing, simplified.
                    </p>
                    <p class="hero-description">
                        Tickets Kenya is a self-service ticketing platform for corporate events tailored for Kenyans
                        that allows anyone to create, share, find, and attend professional events that fuel their
                        career passions and enrich their livelihoods.
                    </p>
                    <a href="{{ url('/events') }}" class="btn btn-primary btn-lg hero-btn">Find Events</a>
                    <a href="{{ url('/create-event') }}" class="btn btn-outline-light btn-lg hero-btn">Create Event</a>
                </div>
            </div>
        </div>
    </div>
    {{-- Events Card --}}
    <div class="container ">
        <div class="row py-2">
            @component('components.events.event-card', [
                'image' => '/images/Golf.jpeg',
                'date' => 'Mar 21, 2025',
                'title' => 'Rotary Club of Karen Charity Golf Event',
                'time' => '06:00 - 18:00',
                'location' => 'Karen Country Club',
                'url' => '#',
            ])
            @endcomponent
        </div>
    </div>

    {{-- Why Choose US section --}}

    <section class="whyChooseUs">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="text-success">EVENT ORGANIZERS</h6>
                    <h1 class="fw-bold">Why Choose Us?</h1>
                    <p>
                        Tickets Kenya is a powerful, simple-to-use online ticketing and event registration platform,
                        delivering market-leading ticketing services and event registration solutions to thousands of live
                        and virtual events each year.
                    </p>
                    {{-- action --}}
                </div>

                <div class="col-lg-6">
                    <div class="row g-3 d-flex justify-content-center align-items-center">
                        <div class="col-md-6 mx-auto">
                            <div class="card card-custom card-blue " style="">
                                <h4 class="py-2">No.1 for Customer Service</h4>
                                <p>We deliver 7 days a week stellar customer service for all our patrons and event
                                    organisers.</p>
                            </div>
                        </div>
                        <div class="col-md-6 row gap-3">
                            <div class="col-md-12">
                                <div class="card card-custom card-green" style="">
                                    <h4 class="py-2">It's FREE for organisers</h4>
                                    <p>Free events are free. Paid events only incur a small consumer booking fee per ticket.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="card card-custom card-black" style="">
                                    <h4 class="py-2">FREE Entry Scanning App</h4>
                                    <p>Our Door Scan Manager App (iOS & Android) quickly validates tickets & ensures rapid
                                        entry
                                        to your event.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
