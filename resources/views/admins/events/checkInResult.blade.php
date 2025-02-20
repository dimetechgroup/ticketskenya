@extends('layouts.guest')

@section('styles')
    <style>
        .ticket-scan-container {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2rem 0px;
        }

        .ticket-card {
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

        .error-icon {
            font-size: 60px;
            color: #dc3545;
            animation: pop 0.5s ease-in-out;
        }

        .successful {
            border: 2px solid #28a745;
        }

        .failed {
            border: 2px solid #dc3545;
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
    <div class="container ticket-scan-container">
        @if ($result['status'] == 1)
            <div class="ticket-card successful">
                <i class="fas fa-check-circle success-icon"></i>
                <h1 class="text-success mt-3">Scanned Successful</h1>
                <p class="lead"> {{ $result['message'] }}</p>

                <a href="{{ url('/') }}" class="btn btn-primary btn-custom-primary mt-3"><i class="fas fa-home"></i> Back
                    to
                    Home</a>
            </div>
        @else
            <div class="ticket-card failed">
                <i class="fas fa-times-circle error-icon"></i>
                <h1 class="text-danger mt-3">Scanned Failed</h1>
                <p class="lead"> {{ $result['message'] }}</p>

                <a href="{{ url('/') }}" class="btn btn-primary btn-custom-primary mt-3"><i class="fas fa-home"></i>
                    Back to
                    Home</a>
        @endif

    </div>
@endsection

@section('scripts')
@endsection
