@extends('layouts.dashboard')

@section('title', 'Create vendor Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create a new vendor</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('vendors.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="username"><strong>Username</strong></label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username') }}" required>
                            </div>
                            <div class="col">
                                <label for="name"><strong>Name</strong></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="email"><strong>Email</strong></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="col">
                                <label for="phone"><strong>Phone</strong></label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address"><strong>Address</strong></label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address') }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mb-1"><strong>Password</strong></label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password" required>
                            </div>
                            <div class="col">
                                <label class="mb-1"><strong>Confirm Password</strong></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Confirm your password" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
