@extends('layouts.guest')

@section('styles')
    @vite(['resources/scss/landingPage/auth.scss'])
@endsection

@section('content')
    <section class="vh-100" style="background-color: rgba(0,0,0,0.2);">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('images/login.jpg') }}" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="d-flex align-items-center mb-3 pb-1 text-black">
                                            <span class="h1 fw-bold mb-0">Tickets Kenya</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account
                                        </h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror" />

                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg @error('password') is-invalid @enderror" />

                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button type="submit" class="btn btn-dark btn-lg btn-block"
                                                type="button">Login</button>
                                        </div>

                                        <a class="small text-muted" href="{{ route('password.email') }}">Forgot
                                            password?</a>
                                        <p class="mb-5 pb-lg-2 text-black">Don't have an account? <a
                                                href="{{ route('register') }}" class="text text-muted">Register here</a></p>
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
