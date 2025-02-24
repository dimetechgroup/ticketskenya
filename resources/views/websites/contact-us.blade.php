@extends('layouts.guest')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
@endsection

@section('content')
    <section class="contact-section py-5">
        <div class="container">
            <div class="row">
                <!-- Contact Details Section -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="contact-info">
                        <h5 class="text-success fw-bold">Location:</h5>
                        <p>92 Banda Lane, Karen<br>Nairobi, Kenya</p>
                        <p>Phone: <a href="tel:+254708178500">+254708178500</a></p>

                        <h5 class="text-success fw-bold">For general enquiries:</h5>
                        <p>If you have a business inquiry, please contact our marketing department.</p>
                        <p><a href="mailto:info@ticketskenya.com">info@ticketskenya.com</a></p>

                        <h5 class="text-success fw-bold">For events enquiries:</h5>
                        <p>Please send event inquiries to the email below.<br>We will get back to you soon.</p>
                        <p><a href="mailto:events@ticketskenya.com">events@ticketskenya.com</a></p>
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form card p-4" style="border:none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <h3 class="text-success fw-bold">Have any questions?</h3>
                        <form method="POST" method="{{ route('landing.contactUs.send') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name"
                                    class="form-control  @error('name') is-invalid @enderror" autocomplete="name"
                                    value="{{ old('name') }}" placeholder="Full name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email"
                                    class="form-control  @error('email') is-invalid @enderror" autocomplete="email"
                                    value="{{ old('email') }}" placeholder="Email address" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone_number"
                                    class="form-control  @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" autocomplete="phone" placeholder="Phone number"
                                    autocomplete="phone_number" required>
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" name="subject"
                                    class="form-control  @error('subject') is-invalid @enderror" autocomplete="subject"
                                    value="{{ old('subject') }}" placeholder="Subject" required>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control  @error('message') is-invalid @enderror" rows="4" placeholder="Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <label for="captcha">Enter the CAPTCHA: <strong
                                                class="captcha">{{ $captcha }}</strong></label>

                                    </div>

                                    <input type="text" class="form-control w-50   @error('captcha') is-invalid @enderror"
                                        name="captcha" value="{{ old('captcha') }}" placeholder="Enter the code"
                                        autocomplete="off" required>
                                    @error('captcha')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">SEND MESSAGE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </body>
    </section>
@endsection
