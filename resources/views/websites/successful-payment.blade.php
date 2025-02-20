@extends('layouts.guest')

@section('styles')
    <style>
        .payment-success-container {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .payment-card {
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background: #ffffff;
        }

        .success-icon {
            font-size: 60px;
            color: #28a745;
            animation: pop 0.5s ease-in-out;
        }

        @keyframes pop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container payment-success-container">
        <div class="payment-card">
            <i class="fas fa-check-circle success-icon"></i>
            <h1 class="text-success mt-3">Payment Successful</h1>
            <p class="lead">Thank you for your payment. Your transaction has been completed, and ticket (s) for your
                purchase
                have been emailed to you. See you at the event! 🎉</p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-custom-primary mt-3"><i class="fas fa-home"></i> Back to
                Home</a>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
