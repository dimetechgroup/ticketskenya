@extends('layouts.guest')
@section('styles')
   <style>
    .whyChooseUs {
     background-image: url("/images/why-us-bg.png");
    background-size: cover;
    background-repeat: no-repeat;
    height: 75vh;

}
   </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <div class="heroSection">
        <div class="container">
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
    <div class="container mt-5">
        <div class="row">
         @component('components.events.event-card', [
            'image' => '/images/Golf.jpeg',
            'date' => 'Mar 21, 2025',
            'title' => 'Rotary Club of Karen Charity Golf Event',
            'time' => '06:00 - 18:00',
            'location' => 'Karen Country Club',
            'url' => '#'
            ])


         @endcomponent
        </div>
    </div>

    {{-- Why Choose US section --}}

    <section class="whyChooseUs col-md-12" >
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6">
                    <h6 class="text-success">EVENT ORGANIZERS</h6>
                    <h1 class="fw-bold">Why Choose Us?</h1>
                    <p>Tickets Kenya is a powerful, simple to use online ticketing and event registration platform, delivering market leading ticketing services and event registration solutions to thousands of live and virtual events each year.</p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="card card-custom card-blue p-4 py-5 mb-4">
                                <h4>No.1 for Customer Service</h4>
                                <p>We deliver 7 days a week stellar customer service for all our patrons and event organisers.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom card-green p-4 mb-4">
                                <h4>It's FREE for organisers</h4>
                                <p>Free events are free. Paid events only incur a small consumer booking fee per ticket.</p>
                            </div>
                            <div class="card card-custom card-black p-4">
                                <h4>FREE Entry Scanning App</h4>
                                <p>Our Door Scan Manager App (iOS & Android) quickly validates tickets & ensures rapid entry to your event.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
