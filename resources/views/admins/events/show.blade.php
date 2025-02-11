{{-- resources/views/admins/events/show.blade.php --}}
@extends('layouts.app')

@section('styles')
    <style>
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Event Details</h4>
            <div class="row">
                {{-- showing event statis here --}}
                <div class="card stat-card bg-primary col-md-4">
                    <h5><i class="la la-ticket"></i> Total Tickets</h5>
                    <h3>{{ $event->tickets_count }}</h3>
                </div>
                <div class="card stat-card bg-success col-md-4">
                    <h5><i class="la la-shopping-cart"></i> Total Orders</h5>
                    <h3>{{ $event->orders_count }}</h3>
                </div>
                <div class="card stat-card bg-warning col-md-4">
                    <h5><i class="la la-money"></i> Total Revenue</h5>
                    <h3>Ksh {{ number_format($event->orders->sum('amount'), 2) }}</h3>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="mb-3">{{ $event->name }}</h3>
                            <p><strong>Date:</strong> {{ $event->date }}</p>
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Organizer:</strong> {{ $event->user->name }} ({{ $event->user->email }})</p>
                            <p><strong>Status:</strong>
                                <span class="badge badge-{{ $event->status == 'approved' ? 'success' : 'warning' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Available Tickets</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Currency</th>
                                        <th>Available Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->name }}</td>
                                            <td>
                                                {{ $ticket->price > 0 ? 'Ksh ' . number_format($ticket->price, 2) : 'Free' }}
                                            </td>
                                            <td>{{ strtoupper($ticket->currency) }}</td>
                                            <td>{{ $ticket->available_qty }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $ticket->status == 'active' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($ticket->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Sales & Orders --}}
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Recent Orders</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>Ksh {{ number_format($order->amount, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Ticket Sales Chart --}}
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Ticket Sales Trend</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>


            </div>
        @endsection

        @section('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var ctx = document.getElementById('salesChart').getContext('2d');
                    var salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($event->orders->pluck('created_at')->map(fn($date) => $date->format('M d'))) !!},
                            datasets: [{
                                label: 'Orders',
                                data: {!! json_encode($event->orders->pluck('amount')) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                });
            </script>
        @endsection
