@extends('layouts.guest')
@section('styles')
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
                <div class="contact-form card p-4" style="border:none; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" >
                    <h3 class="text-success fw-bold">Have any questions?</h3>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Full name" required>
                            <div class="text-danger">Name cannot be blank.</div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Message" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Verification Code</label>
                            <div class="d-flex align-items-center">
                                <img src="/images/captcha.png" alt="Captcha" class="me-3">
                                <input type="text" class="form-control w-50" required>
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
