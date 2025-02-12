@extends('layouts.guest')

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
@endsection
