@extends('layouts.app')

@section('title', 'Attendees for ' . $event->name)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">
                Attendees for {{ $event->name }}
            </h2>

        </div>

        <!-- Summary Cards -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body">
                        <h5>Total Attendees</h5>
                        <h3 class="fw-bold">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body">
                        <h5>Active Attendees</h5>
                        <h3 class="fw-bold">0</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body">
                        <h5>Inactive Attendees</h5>
                        <h3 class="fw-bold">0</h3>
                    </div>
                </div>
            </div>

        </div>

        <!-- Events Table -->
        <div class="card mt-4 shadow">
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>

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

@endsection
