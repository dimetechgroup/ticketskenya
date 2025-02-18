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
                            <p class="display-6 fw-bold">{{ $total_attendees }}</p>
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
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-primary">
                                <tr class=" text-uppercase text-muted">

                                    <th>Attendee</th>
                                    <th>Order</th>
                                    <th>Ticket</th>
                                    <th>Status</th>
                                    <th>Check-In Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="attendeesTable">
                                @forelse ($event->orders as $order)
                                    @foreach ($order->orderItems as $index => $attendee)
                                        <tr>
                                            <td>
                                                <div> {{ $attendee->attendee_name }}</div>
                                                <div>
                                                    <small
                                                        class="text-muted fw-light">{{ $attendee->attendee_email }}</small>
                                                </div>
                                                <div>
                                                    <small
                                                        class="text-muted fw-light">{{ $attendee->attendee_phone }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $order->order_number }}
                                            </td>

                                            <td>{{ $attendee->ticket->name }}</td>
                                            <td>
                                                {{-- check if order is paid  --}}
                                                @if ($order->payment_status === 'successful')
                                                    @if ($attendee->status === 'valid')
                                                        <span class="badge bg-success">Valid</span>
                                                    @elseif ($attendee->status === 'used')
                                                        <span class="badge bg-primary">Checked In</span>
                                                    @elseif ($attendee->status === 'cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-danger">Unpaid</span>
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

                                                <a href="{{ route('attendees.download-ticket', $attendee) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> Download Ticket
                                                </a>
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


        });
    </script>
@endsection
