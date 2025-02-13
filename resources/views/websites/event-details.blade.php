@extends('layouts.guest')

@section('title', $event->name)
<style>
    .banner {
        background: linear-gradient(135deg, #2b2f77, #4b5bb7);
        color: white;
        padding: 2rem;
        border-radius: 10px;
    }
    .banner h1 {
        font-weight: bold;
    }
    .banner h3 {
        color: #f29c32;
    }
    .card-custom {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .btn-buy {
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
    }
    .btn-buy:hover {
        background-color: #218838;
    }
</style>

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Left Section -->
        <div class="col-md-7">
            <div class="banner">
                <h4><i class="bi bi-camera-video"></i> Webinar</h4>
                <h1>Founders and Mental Health</h1>
                <h3>To survive or to thrive</h3>
                <p><strong>with Serah Muindi</strong><br>Founder: Hopewell Firm</p>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-calendar-event me-2"></i>
                    <span>27th March, 2025 | 11:00am - 01:00pm EAT / 9 am BST</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span>Zoom</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-ticket me-2"></i>
                    <span>at <strong>1000 sh only</strong></span>
                </div>
                <div class="d-flex gap-3">
                    <img src="https://via.placeholder.com/100x50?text=SNDBX" alt="SNDBX">
                    <img src="https://via.placeholder.com/100x50?text=Hopewell" alt="Hopewell">
                    <img src="https://via.placeholder.com/100x50?text=Sema" alt="Sema">
                    <img src="https://via.placeholder.com/100x50?text=Ennovate" alt="Ennovate">
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="col-md-5">
            <div class="card card-custom p-3">
                <small class="text-muted">Thu, 27th Mar 2025</small>
                <h2>Founders and Mental Health Webinar</h2>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-clock me-2"></i>
                    <span>11:00 - 13:00</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span>Zoom</span>
                </div>
                <p>
                    <strong>Entrepreneurship</strong> is rewarding but often comes with
                    <strong>mental</strong> and <strong>financial pressures</strong>.
                    Founders face <strong>burnout</strong>, <strong>isolation</strong>,
                    and limited mental health resources, which can harm both personal well-being and business success.
                </p>
                <p>
                    This webinar targets entrepreneurs, business leaders, investors, and key players in the ecosystem,
                    uniting diverse voices to address these challenges.
                </p>
                <div class="alert alert-light border">
                    <div class="d-flex justify-content-between">
                        <span>Founders and Mental Health Virtual Ticket</span>
                        <span class="text-danger text-decoration-line-through">KES 3000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>200 remaining</span>
                        <span class="text-success"><strong>KES 1000</strong></span>
                    </div>
                    <button class="btn btn-buy w-100 mt-3">KES 1000 Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
