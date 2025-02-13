@extends('layouts.guest')
@section('styles')
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
    <div class="container pt-2 ">
        <div class="row py-2">
            @foreach ($current_future_events as $event)
                @component('components.events.event-card', [
                    'image' => $event->image_url,
                    'date' => $event->start_date->format('M d,Y H:s'),
                    'title' => $event->name,
                    'venue' => $event->venue,
                    'url' => route('event.single', $event->slug),
                ])
                @endcomponent
            @endforeach

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
                    <a class="btn btn-primary btn-lg hero-btn text-white" href="{{ route('login') }}">
                        Create Your Event
                    </a>

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

    {{-- Testimonials --}}
    <section class="testimonials-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image Section -->
                <div class="col-lg-6 col-md-12 px-5">
                    <div class="image">
                        <img src="/images/testimonial.png" alt="Testimonials" class="img-fluid">
                    </div>
                </div>
                <!-- Text Section -->
                <div class="col-lg-6 col-md-12">
                    <h6 class="text-success">REVIEWS</h6>
                    <h1 class="fw-bold">WHAT PEOPLE SAY?</h1>
                    <p class="testimonial-quote">
                        "Can I just say that it's been an absolute pleasure working with you all.
                        Everyone's been so friendly, helpful and delightful, so please pass my
                        thanks on to the team!"
                    </p>
                    <p class="testimonial-author">
                        <strong>Rubina Kibe,</strong><br>
                        Event Manager and Director
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- past events --}}
    <section class="past-events">
        <div class="container">
            <div class="text-center py-5">
                  <h6 class="text-success">PAST EVENTS</h6>
            <h1 class="fw-bold">Events You Missed</h1>
            </div>

            <div class="row">
                @component('components.events.event-card', [
                    'image' => '/images/Concert.jpeg',
                    'date' => 'Mar 21, 2025',
                    'title' => 'Rotary Club of Karen Charity Golf Event',
                    'time' => '06:00 - 18:00',
                    'location' => 'Karen Country Club',
                    'url' => '#',
                ])
                @endcomponent
            </div>
        </div>
@endsection
