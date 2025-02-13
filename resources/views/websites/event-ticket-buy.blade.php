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
        <form action="" method="POST" class="row">
            @csrf
            <div class="col-md-8">
                <div class="row">


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

                </div>
            </div>
            {{-- calculation and summary here --}}
            <div class="col-md-4 order-md-2 mb-4 px-5 mt-3">
                <div class="alert alert-info d-none" role="alert" id="has-discount">
                    You qualify for a discount ! 🎉
                </div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Order summary</span>

                </h4>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed p-4">
                        <div>
                            <h6 class="my-0">{{ $ticket->name }}</h6>
                        </div>
                        <strong>
                            <span class="text-muted" id="summary-quantity">1 x</span>
                            <span class="text-muted">12000</span>
                        </strong>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Processing Fee</span>
                        <span> {{ $ticket->currency }} <strong id="processing_fee">{{ $event->processing_fee }}
                            </strong></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Discount</span>
                        <span>{{ $ticket->currency }} <span id="discount"> 0</span>
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <span>{{ $ticket->currency }}<strong id="total">0</strong>
                        </span>
                    </li>

                </ul>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required="">
                    <label class="form-check-label" for="flexCheckDefault">
                        By submitting this form, I agreee to ticketskenya.com <a
                            href="https://ticketskenya.com/site/page?id=3" target="_blank"> terms and conditions</a>
                    </label>
                </div>


                <button type="submit" class="btn btn-primary btn-custom-primary  mt-3 float-end">Place order</button>

            </div>

        </form>
    @endsection

    @section('scripts')

    @endsection
