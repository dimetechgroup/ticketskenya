@extends('layouts.guest')

@section('title', 'Buy Tickets For ' . $event->name)

@section('styles')
    @vite('resources/scss/landingPage/eventDetails.scss')
@endsection

@section('content')
    <div class="container my-5">
        <h2 class="text-center">{{ $event->name }}</h2>
        <p class="text-center">{{ $event->description }}</p>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <form action="" method="post" class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            placeholder="Email Address" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            placeholder="Phone Number" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="number_tickets">Number Of Tickets</label>
                        <select id="number_tickets" class="form-control" name="number_tickets">
                            @for ($i = 1; $i < $ticket->max_per_user; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Other Attendees form inputs from second : dynamically created and deleted --}}
                    <div id="other-attendees"></div>



                </form>
            </div>
            {{-- calculation and summary here --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Summary</h5>
                        <p class="card-text">Ticket: {{ $ticket->name }}</p>
                        <p class="card-text">Price: 1 * {{ $ticket->currency . ' ' . number_format($ticket->price) }}</p>

                    </div>

                </div>


            </div>
        @endsection

        @section('scripts')

        @endsection
