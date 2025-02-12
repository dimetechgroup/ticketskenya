@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Hero Section -->
        <section class="hero text-center mb-5">
            <h1 class="display-4 fw-bold text-dark">Corporate event ticketing, simplified.</h1>
            <p class="lead text-muted">Tickets Kenya allows you to plan, promote and sell event tickets with ease.</p>
            <a href="#" class="btn btn-success text-white shadow-sm">Browse Events</a>
        </section>

        <!-- Upcoming Events Section -->
        <section class="mb-5">
            <h2 class="text-center">Upcoming Events</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">Golf Charity Event</h5>
                            <p class="card-text text-secondary">Join us for a charity golf event.</p>
                            <a href="#" class="btn btn-outline-primary">Details & Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">Mental Health Webinar</h5>
                            <p class="card-text text-secondary">Learn about mental health and wellness.</p>
                            <a href="#" class="btn btn-outline-primary">Details & Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary">TEACON 2025</h5>
                            <p class="card-text text-secondary">The leading tech conference of 2025.</p>
                            <a href="#" class="btn btn-outline-primary">Details & Ticket</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="text-center mb-5">
            <h2>Why Choose Us?</h2>
            <p>We offer the best ticketing solutions for event organizers and attendees.</p>
            <div class="row">
                <div class="col-md-4">
                    <h5>Free for Organizers</h5>
                    <p>No upfront costs. Start organizing events instantly.</p>
                </div>
                <div class="col-md-4">
                    <h5>Real-Time Customer Support</h5>
                    <p>We provide 24/7 support for both event organizers and attendees.</p>
                </div>
                <div class="col-md-4">
                    <h5>Event Scanning App</h5>
                    <p>Scan tickets easily with our free mobile app.</p>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="text-center mb-5">
            <h2>What People Say?</h2>
            <blockquote class="blockquote fst-italic text-secondary">
                <p class="mb-0">"Amazing platform! Super easy to use and very reliable."</p>
                <footer class="blockquote-footer text-muted">Jane Doe, Event Organizer</footer>
            </blockquote>
        </section>

        <!-- Footer Section -->
        <footer class="text-center mt-5 bg-dark text-white py-4">
            <p>&copy; 2025 Tickets Kenya. All rights reserved.</p>
        </footer>
    </div>
@endsection
