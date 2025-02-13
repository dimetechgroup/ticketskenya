{{-- resources/views/admins/events/attendees.blade.php --}}
@extends('layouts.app')

@section('title', 'Attendees for ' . $event->name)

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">
                    Attendees for {{ $event->name }}
                </h2>
                <a href="" class="btn btn-primary">
                    <i class="fas fa-download"></i> Export CSV
                </a>
            </div>

            <!-- Event Summary Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Total Attendees</h5>
                            <p class="display-6 fw-bold">{{ $event->orders->sum('orderItems.quantity') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success">Checked In</h5>
                            <p class="display-6 fw-bold">
                                {{ $event->orders->flatMap->orderItems->whereNotNull('checkin_time')->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-warning">Pending Check-In</h5>
                            <p class="display-6 fw-bold">
                                {{ $event->orders->flatMap->orderItems->whereNull('checkin_time')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendees Table -->
            <div class="card mt-4 shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Attendee List</h5>
                </div>
                <div class="card-body">
                    <!-- Search Field -->
                    <div class="mb-3">
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Search attendees by name or email">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-primary">
                                <tr class="text-center text-uppercase text-muted">
                                    <th>#</th>
                                    <th>Attendee</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Ticket</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Check-In Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="attendeesTable">
                                @forelse ($event->orders as $order)
                                    @foreach ($order->orderItems as $index => $attendee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendee->attendee_name }}</td>
                                            <td>{{ $attendee->attendee_email }}</td>
                                            <td>{{ $attendee->attendee_phone }}</td>
                                            <td>{{ $attendee->ticket->name }}</td>
                                            <td>{{ $attendee->quantity }}</td>
                                            <td>
                                                @if ($attendee->status === 'valid')
                                                    <span class="badge bg-success">Valid</span>
                                                @elseif ($attendee->status === 'used')
                                                    <span class="badge bg-primary">Checked In</span>
                                                @elseif ($attendee->status === 'cancelled')
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($attendee->checkin_time)
                                                    {{ \Carbon\Carbon::parse($attendee->checkin_time)->format('d M Y, H:i') }}
                                                @else
                                                    <span class="text-muted">Not checked in</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$attendee->checkin_time)
                                                    <button class="btn btn-success btn-sm checkin-btn"
                                                        data-id="{{ $attendee->id }}">
                                                        <i class="fas fa-check"></i> Check In
                                                    </button>
                                                @else
                                                    <button class="btn btn-outline-secondary btn-sm" disabled>
                                                        <i class="fas fa-check-double"></i> Checked In
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No attendees found for this event.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Search Functionality
            document.getElementById("searchInput").addEventListener("input", function() {
                let filter = this.value.toLowerCase();
                let rows = document.querySelectorAll("#attendeesTable tr");

                rows.forEach(row => {
                    let name = row.cells[1]?.textContent.toLowerCase();
                    let email = row.cells[2]?.textContent.toLowerCase();
                    row.style.display = (name.includes(filter) || email.includes(filter)) ? "" :
                        "none";
                });
            });

            // Check-in Button Click Event
            document.querySelectorAll(".checkin-btn").forEach(button => {
                button.addEventListener("click", function() {
                    let attendeeId = this.getAttribute("data-id");

                    fetch(`/events/attendees/checkin/${attendeeId}`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute("content"),
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Attendee checked in successfully!");
                                location.reload();
                            } else {
                                alert("Check-in failed. Please try again.");
                            }
                        });
                });
            });
        });
    </script>
@endsection
