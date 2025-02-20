@extends('layouts.guest')

@section('title', $event->name)

@section('styles')
    @vite('resources/scss/landingPage/eventDetails.scss')
@endsection

@section('content')
    <div class="container my-5">
        <div class="row event-container">
            <div class="col-md-6">
                {{-- Image --}}
                <img src="{{ $event->image_url }}" class="img-fluid event-img" alt="{{ $event->name }}">
            </div>
            <div class="col-md-6">
                {{-- Event Details --}}
                <h2 class="mb-3">{{ $event->name }}</h2>
                <div class="row">
                    <p class="text-muted col-md-6"><i class="fas fa-map-marker-alt"></i> {{ $event->venue }}</p>
                    <p class="text-muted col-md-6"><i class="fas fa-calendar-day"></i> Start Date: {{ $event->start_date }}
                    </p>
                    <p class="text-muted col-md-6"><i class="fas fa-clock"></i> Time: {{ $event->end_date }}</p>
                    <p class="text-muted col-md-6"><i class="fas fa-envelope"></i> {{ $event->contact_email }}</p>
                </div>

                <p>{!! $event->description !!}</p>


                {{-- Tickets --}}
                <h4 class="mt-5">Tickets <i class="fas fa-ticket-alt"></i></h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Available Tickets</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->currency . ' ' . number_format($ticket->price) }}</td>
                                <td>{{ $ticket->quantity }}</td>
                                <td>
                                    <a href="{{ route('event.ticket.buy', ['event' => $event->slug, 'ticket' => $ticket->id]) }}"
                                        class="btn btn-primary buy-btn"><i class="fas fa-cart-plus"></i>
                                        Buy</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".event-container").classList.add("animate__animated", "animate__fadeInUp");
        });
    </script>
@endsection
