@extends('layouts.guest')
@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-body">
                        <h1 class="text-success">Payment Successful</h1>
                        <p class="lead">Thank you for your payment. Your transaction has been completed, and a receipt for
                            your purchase has been emailed to you. You may log into your account at <a
                                href="{{ route('login') }}">www.ticketskenya.com</a> to view details of this transaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
