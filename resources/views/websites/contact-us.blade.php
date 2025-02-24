@extends('layouts.guest')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contact-us.css') }}">
    <style>
        /* Contact Section Styling */
        .contact-section {
            background: #f8f9fa;
            padding: 60px 0;
            animation: fadeInUp 1s ease-in-out;
        }

        .contact-info h5 {
            font-weight: bold;
            color: #28a745;
            margin-top: 15px;
        }

        .contact-info p {
            font-size: 16px;
            color: #333;
        }

        .contact-info a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        /* Contact Form Styling */
        .contact-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeInRight 1s ease-in-out;
        }

        .contact-form input,
        .contact-form textarea {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 16px;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #28a745;
            box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
        }

        .contact-form .btn-success {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

        .contact-form .btn-success:hover {
            background-color: #218838;
            transform: scale(1.02);
        }

        /* Fade-in Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
@endsection

@section('content')
    <section class="contact-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Contact Details Section -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="contact-info">
                        <h2 class="text-success fw-bold mb-4">Get in Touch</h2>
                        <h5>Location:</h5>
                        <p>92 Banda Lane, Karen, Nairobi, Kenya</p>
                        <p><strong>Phone:</strong> <a href="tel:+254708178500">+254708178500</a></p>

                        <h5>General Enquiries:</h5>
                        <p>For business inquiries, contact our marketing team:</p>
                        <p><a href="mailto:info@ticketskenya.com">info@ticketskenya.com</a></p>

                        <h5>Event Enquiries:</h5>
                        <p>Send event-related questions here:</p>
                        <p><a href="mailto:events@ticketskenya.com">events@ticketskenya.com</a></p>

                        <!-- Google Map -->
                        <div class="mt-4">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4824.850027512968!2d36.756147075764666!3d-1.3679726357225017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1732a072adb5%3A0x64b65786594e68da!2sDimetech%20Group!5e1!3m2!1sen!2ske!4v1740404678804!5m2!1sen!2ske"
                                width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="col-lg-6 col-md-12">
                    <div class="contact-form card p-4">
                        <h3 class="text-success fw-bold mb-3">Have any questions?</h3>
                        <form method="POST" action="{{ route('landing.contactUs.send') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="Full name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="Email address" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone_number"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number') }}" placeholder="Phone number" required>
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="text" name="subject"
                                    class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}"
                                    placeholder="Subject" required>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="4"
                                    placeholder="Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="captcha" class="d-block">Enter the CAPTCHA: <strong
                                        class="captcha">{{ $captcha }}</strong></label>
                                <input type="text" name="captcha"
                                    class="form-control w-50 d-inline-block @error('captcha') is-invalid @enderror"
                                    value="{{ old('captcha') }}" placeholder="Enter the code" required>
                                @error('captcha')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">SEND MESSAGE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Smooth fade-in for page elements
            document.querySelectorAll('.contact-section').forEach(section => {
                section.style.opacity = 0;
                setTimeout(() => section.style.opacity = 1, 500);
            });

            // Form button hover effect
            document.querySelector('.btn-success').addEventListener('mouseover', function() {
                this.style.backgroundColor = '#218838';
                this.style.transform = 'scale(1.02)';
            });

            document.querySelector('.btn-success').addEventListener('mouseout', function() {
                this.style.backgroundColor = '#28a745';
                this.style.transform = 'scale(1)';
            });
        });
    </script>
@endsection
