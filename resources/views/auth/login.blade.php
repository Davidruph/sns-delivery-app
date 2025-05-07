@extends('layouts.app')

@section('title', 'Login Page')

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-contain-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="row m-0 align-items-center">
                            <div class="col-xl-6 col-md-6 sign text-center">
                                <div>
                                    <img src="images/log.png" class="education-img"></img>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="sign-in-your">
                                    <h3>Sign in your account</h3>
                                    <span class="text-white">Welcome back! Login with your data that you entered<br> during
                                        registration</span>

                                    @include('alerts.index')

                                    <form action="{{ route('login.post') }}" method="POST" class="mt-4">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" placeholder="hello@example.com"
                                                class="form-control" value="{{ old('email') }}" required autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required
                                                placeholder="Enter your password">
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="mb-3">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember my
                                                        preference</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <a href="page-forgot-password.html">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>

                                    <div class="new-account mt-3">
                                        <p class="text-white">Don't have an account? <a class="text-primary"
                                                href="{{ route('register') }}">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
