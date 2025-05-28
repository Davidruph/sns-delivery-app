@extends('layouts.app')

@section('title', 'Register Page')

@section('content')
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-6 col-md-6 sign text-center">
                            <div>
                                <img src="{{ asset('images/landing-pg01.png') }}" class="education-img"></img>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="auth-form">
                                <h3 class="">Welcome to Seekers Digital Network</h3>
                                <span class="text-white">Sign up to manage your deliveries, inventory, and order
                                    statuses.</span>
                                @include('alerts.index')
                                <form action="{{ route('register.post') }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Username</strong></label>
                                        <input type="text" name="username" class="form-control" placeholder="username"
                                            value="{{ old('username') }}" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control"
                                            placeholder="hello@example.com" value="{{ old('email') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter your password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Confirm Password</strong></label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirm your password" required>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">Already have an account? <a class="text-primary"
                                            href="{{ route('login') }}">Sign in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
