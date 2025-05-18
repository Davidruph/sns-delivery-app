@extends('layouts.dashboard')

@section('title', 'Profile Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="avatar"><strong>Avatar</strong></label><br>
                            @if ($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" width="100"
                                    class="mb-2 rounded">
                            @endif
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ old('username', $user->username) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone"><strong>Phone</strong></label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone', $user->phone) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="address"><strong>Address</strong></label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ old('address', $user->address) }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
