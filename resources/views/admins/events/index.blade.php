@extends('layouts.app')

@section('title', 'Event Management')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Event Management</h2>
            <a href="{{ route('events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Event
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5>Total Events</h5>
                        <h3 class="fw-bold">{{ $events->count() }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <h3 class="fw-bold">Ksh {{ number_format($events->sum('total_revenue'), 2) }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5>Total Tickets Sold</h5>
                        <h3 class="fw-bold">{{ $events->sum('total_tickets_sold') }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger shadow">
                    <div class="card-body">
                        <h5>Total Orders</h5>
                        <h3 class="fw-bold">{{ $events->sum('orders_count') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue & Orders Chart -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Revenue Trend</h5>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Orders Trend</h5>
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Table -->
        <div class="card mt-4 shadow">
            <div class="card-body">
                <h5 class="card-title">Event List</h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Start Date</th>
                                <th>Revenue</th>
                                <th>Tickets Sold</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $index => $event)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('events.show', $event->id) }}" class="text-primary fw-bold">
                                            {{ $event->name }}
                                        </a>
                                    </td>
                                    <td>{{ $event->venue }}</td>
                                    <td>
                                        <x-admins.events.status-badge :status="$event->status" />

                                    </td>
                                    <td>{{ $event->start_date->format('M d, Y') }}</td>
                                    <td>Ksh {{ number_format($event->total_revenue, 2) }}</td>
                                    <td>{{ $event->total_tickets_sold }}</td>
                                    <td>
                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $events->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let revenueCtx = document.getElementById('revenueChart').getContext('2d');
            let ordersCtx = document.getElementById('ordersChart').getContext('2d');

            let revenueData = {!! json_encode($events->pluck('total_revenue')) !!};
            let ordersData = {!! json_encode($events->pluck('orders_count')) !!};
            let eventLabels = {!! json_encode($events->pluck('name')) !!};

            new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: eventLabels,
                    datasets: [{
                        label: 'Total Revenue (Ksh)',
                        data: revenueData,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });

            new Chart(ordersCtx, {
                type: 'line',
                data: {
                    labels: eventLabels,
                    datasets: [{
                        label: 'Total Orders',
                        data: ordersData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                }
            });
        });
    </script>
@endsection
