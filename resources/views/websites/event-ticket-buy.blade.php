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
        <form action="{{ route('event.ticket.purchase', ['event' => $event->slug]) }}" method="POST" class="row">
            @csrf
            <div class="col-md-8">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name"
                            required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address"
                            required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            placeholder="Phone Number" required />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="number_tickets">Number Of Tickets</label>
                        <select id="number_tickets" class="form-control" name="number_tickets" required>
                            @for ($i = 1; $i <= $ticket->max_per_user; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Other Attendees form inputs from second: dynamically created --}}
                    <div id="other-attendees"></div>

                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-md-4 order-md-2 mb-4 px-2 mt-3">
                <div class="alert alert-info d-none" role="alert" id="has-discount">
                    You qualify for a discount! 🎉
                </div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Order Summary</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed p-4">
                        <div>
                            <h6 class="my-0">{{ $ticket->name }}</h6>
                        </div>
                        <strong>
                            <span class="text-muted" id="summary-quantity">1 x</span>
                            <span class="text-muted">{{ $ticket->currency }} <span
                                    id="ticket-price">{{ $ticket->price }}</span></span>
                        </strong>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Processing Fee</span>
                        <span>{{ $ticket->currency }} <strong
                                id="processing_fee">{{ $event->processing_fee }}</strong></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Discount</span>
                        <span>{{ $ticket->currency }} <span id="discount">0</span></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <span>{{ $ticket->currency }} <strong id="total">0</strong></span>
                    </li>
                </ul>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                    <label class="form-check-label" for="flexCheckDefault">
                        By submitting this form, I agree to <a href="https://ticketskenya.com/site/page?id=3"
                            target="_blank">terms and conditions</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-custom-primary mt-3 float-end">Place Order</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ticketDropdown = document.getElementById("number_tickets");
            const otherAttendeesDiv = document.getElementById("other-attendees");
            const ticketPrice = parseFloat(document.getElementById("ticket-price").innerText);
            const processingFee = parseFloat(document.getElementById("processing_fee").innerText);
            const discountSpan = document.getElementById("discount");
            const totalSpan = document.getElementById("total");
            const hasDiscountAlert = document.getElementById("has-discount");

            function updateTotal() {
                let quantity = parseInt(ticketDropdown.value);
                let discount = 0;
                let totalPrice = ticketPrice * quantity + processingFee;

                // Example Discount Logic: 10% off for 5 or more tickets
                if (quantity >= 5) {
                    discount = totalPrice * 0.10;
                    hasDiscountAlert.classList.remove("d-none");
                } else {
                    hasDiscountAlert.classList.add("d-none");
                }

                totalPrice -= discount;

                discountSpan.innerText = discount.toFixed(2);
                totalSpan.innerText = totalPrice.toFixed(2);
            }

            function generateAttendeeFields() {
                otherAttendeesDiv.innerHTML = ""; // Clear previous inputs
                let quantity = parseInt(ticketDropdown.value);

                for (let i = 1; i < quantity; i++) {
                    let attendeeForm = `
                        <div class="attendee-entry border p-3 mb-2">
                            <h6>Attendee ${i + 1}</h6>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="attendee_name_${i}" class="form-label">Full Name</label>
                                    <input type="text" name="attendees[${i}][name]" class="form-control" required placeholder="Full Name">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="attendee_email_${i}" class="form-label">Email</label>
                                    <input type="email" name="attendees[${i}][email]" class="form-control" required placeholder="Email Address">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="attendee_phone_${i}" class="form-label">Phone Number</label>
                                    <input type="text" name="attendees[${i}][phone]" class="form-control" required placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                    `;
                    otherAttendeesDiv.insertAdjacentHTML("beforeend", attendeeForm);
                }
            }

            ticketDropdown.addEventListener("change", function() {
                generateAttendeeFields();
                updateTotal();
            });

            updateTotal(); // Initial calculation
        });
    </script>
@endsection
