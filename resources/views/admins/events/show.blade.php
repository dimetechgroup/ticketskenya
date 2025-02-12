@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css">
    <style>
        .card-statistics {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .card-statistics h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-statistics p {
            font-size: 14px;
            color: #6c757d;
        }

        .event-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="page-title">Event Details</h4>
                <div>
                    {{-- link to create ticket --}}
                    <a href="{{ route('events.tickets.create', ['event' => $event->id]) }}" class="btn btn-primary">Create
                        Ticket</a>
                    {{-- link to create order --}}

                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Event Overview Section -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset($event->image_url) }}" class="img-fluid img-thumbnail event-image"
                                alt="Event Image">
                            <h3 class="mt-3">{{ $event->name }}</h3>
                            <p class="text-muted">{!! $event->description !!}</p>
                            <p><strong>Venue:</strong> {{ $event->venue }} ({{ ucfirst($event->location) }})</p>
                            <p><strong>Start Date:</strong> {{ $event->start_date->format('M d, Y h:i A') }}</p>
                            <p><strong>End Date:</strong> {{ $event->end_date->format('M d, Y h:i A') }}</p>
                            <p><strong>Contact:</strong> {{ $event->contact_email }} | {{ $event->contact_number }}</p>
                            <p><strong>Status:</strong> <span
                                    class="badge bg-{{ $event->status == 'approved' ? 'success' : 'warning' }}">{{ ucfirst($event->status) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Statistics Panel -->
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5 class="text-center">Event Statistics</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="card-statistics">
                                    <h5>{{ $ticketsSold }}</h5>
                                    <p>Tickets Sold</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-statistics">
                                    <h5>{{ $event->tickets->sum('available_qty') - $ticketsSold }}</h5>
                                    <p>Tickets Left</p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="card-statistics">
                                    <h5>{{ $attendeesCheckedIn }}</h5>
                                    <p>Checked-in</p>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="card-statistics">
                                    <h5>{{ $totalAttendees - $attendeesCheckedIn }}</h5>
                                    <p>Pending Check-ins</p>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="card-statistics">
                                    <h5>${{ number_format($totalRevenue, 2) }}</h5>
                                    <p>Total Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket and Order Details -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Tickets</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Sold</th>
                                        <th>Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->name }}</td>
                                            <td>${{ number_format($ticket->price, 2) }}</td>
                                            <td>{{ $ticket->sold_quantity }}</td>
                                            <td>{{ $ticket->quantity - $ticket->sold_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Revenue Breakdown</h5>
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- order details --}}

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Orders</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>order_number</th>
                                        <th>Total Amount</th>
                                        <th>Currency</th>
                                        <th>Payment Status</th>
                                        <th>Tickets</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td>{{ $order->currency }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>
                                                {{ $order->orderItems->count() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tickets Sold', 'Revenue'],
                datasets: [{
                    label: 'Event Statistics',
                    data: [{{ $ticketsSold }}, {{ $totalRevenue }}],
                    backgroundColor: ['#007bff', '#28a745'],
                    borderColor: ['#007bff', '#28a745'],
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection
