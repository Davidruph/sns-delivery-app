@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-contain-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="row m-0 align-items-center">
                            <div class="col-xl-6 col-md-6 sign text-center">
                                <div>
                                    <img src="{{ asset('images/log.png') }}" class="education-img"></img>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="sign-in-your">
                                    <h1 class="mt-5">Welcome to the Delivery App</h1>
                                    <p class="lead">This is a simple application to manage deliveries.</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
