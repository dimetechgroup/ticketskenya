@extends('layouts.guest')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section text-white text-center">
        <div class="container">
            <h1 class="display-4" data-aos="fade-up">About Us</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="200">
                Learn more about our vision, mission, and how our ticketing system helps businesses thrive.
            </p>
        </div>
    </section>

    {{-- About Us Section --}}
    <section class="about-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <h2>Who We Are</h2>
                    <p>
                        We are a leading provider of modern ticketing solutions, helping businesses streamline their
                        operations.
                        With a focus on innovation and customer satisfaction, we deliver reliable and efficient systems
                        tailored to meet your needs.
                    </p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <img src="{{ asset('images/login.jpg') }}" alt="About Us" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    {{-- Vision and Mission Section --}}
    <section class="vision-mission-section bg-light py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6" data-aos="zoom-in">
                    <h2>Our Vision</h2>
                    <p>
                        To revolutionize the ticketing industry by providing seamless, secure, and efficient solutions.
                    </p>
                </div>
                <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <h2>Our Mission</h2>
                    <p>
                        To empower businesses with state-of-the-art ticketing systems, ensuring ease of use and unparalleled
                        customer experience.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Ticketing System Section --}}
    <section class="ticketing-system py-5">
        <div class="container">
            <h2 class="text-center mb-4" data-aos="fade-up">How Our Ticketing System Works</h2>
            <div class="row">
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('images/login.jpg') }}" alt="Step 1" class="img-fluid">
                    <h4>Step 1: Easy Ticket Creation</h4>
                    <p>
                        Our platform allows users to register and create tickets for their events, making it easy for
                        customers to purchase and manage their tickets. With a user-friendly interface and robust features,
                        our system ensures a seamless experience for both event organizers and attendees.
                    </p>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <img src="{{ asset('images/login.jpg') }}" alt="Step 2" class="img-fluid">
                    <h4>Step 2: Efficient Management</h4>
                    <p>
                        Event organizers can easily manage their events, track ticket sales, and generate reports to gain
                        insights into their audience. Our system provides real-time data and analytics to help businesses
                        make informed decisions and optimize their ticketing strategies.

                    </p>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                    <img src="{{ asset('images/login.jpg') }}" alt="Step 3" class="img-fluid">
                    <h4>Step 3: Quick Resolution</h4>
                    <p>
                        In case of any issues or inquiries, our dedicated customer support team is available to assist users
                        and provide timely solutions. We prioritize customer satisfaction and strive to deliver exceptional
                        service to ensure a positive experience for all our clients.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action Section --}}
    <section class="cta-section text-white text-center py-5">
        <div class="container">
            <h2 data-aos="fade-up">Get Started with Our Ticketing System Today</h2>
            <p data-aos="fade-up" data-aos-delay="200">Join thousands of businesses using our innovative solution.</p>
            <a href="{{ route('landing.contactUs') }}" class="btn btn-info btn-lg mt-3" data-aos="fade-up"
                data-aos-delay="300">
                Contact Us
            </a>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
@endsection
