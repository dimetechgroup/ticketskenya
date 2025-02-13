<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>{{ config('app.name', 'Welcome To Ticket Kenya') }}</title>

    @vite(['resources/scss/landingPage/app.scss', 'resources/js/app.ts'])
    @yield('styles' )
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Ticket Kenya" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/events') }}">Browse Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ url('/login') }}">Add Event</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Advanced Footer -->
    <footer class="footer  text-light pt-5">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <!-- Branding & About -->
                <div class="col-lg-4 col-md-6">
                    <div class="fw-bold py-2">
                        <img src="{{ asset('images/logo.png') }}" alt="Ticket Kenya" height="40">
                    </div>
                    <p class="small">Your go-to platform for booking tickets to concerts, sports events, and festivals.
                        We make ticket purchasing easy and secure.</p>
                    <a href="{{ url('/about') }}" class="text-white small">Learn More →</a>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-3">
                    <h6 class="fw-bold">Quick Links</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ url('/') }}" class="text-white">Home</a></li>
                        <li><a href="{{ url('/events') }}" class="text-white">Events</a></li>
                        <li><a href="{{ url('/pricing') }}" class="text-white">Pricing</a></li>
                        <li><a href="{{ url('/faq') }}" class="text-white">FAQ</a></li>
                    </ul>
                </div>

                <!-- Customer Support -->
                <div class="col-lg-3 col-md-3">
                    <h6 class="fw-bold">Customer Support</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ url('/contact') }}" class="text-white">Contact Us</a></li>
                        <li><a href="{{ url('/refund-policy') }}" class="text-white">Refund Policy</a></li>
                        <li><a href="{{ url('/terms') }}" class="text-white">Terms of Service</a></li>
                        <li><a href="{{ url('/privacy') }}" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Newsletter & Social Media -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold">Stay Connected</h6>
                    <p class="small">Subscribe to our newsletter for exclusive event updates and promotions.</p>
                    <form>
                        <div class="input-group mb-2">
                            <input type="email" class="form-control form-control-sm" placeholder="Enter your email"
                                required>
                            <button class="btn btn-info btn-sm" type="submit">Subscribe</button>
                        </div>
                    </form>
                    <div>
                        <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Copyright & Credits -->
                <div class="text-center col-lg-12 bottom-footer mt-4 ">
                    <p class="small mb-0">&copy; {{ date('Y') }} Ticket Kenya. All Rights Reserved.</p>
                </div>
            </div>


        </div>
    </footer>

</body>

</html>
