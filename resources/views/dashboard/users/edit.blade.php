@extends('layouts.dashboard')

@section('title', 'User Edit Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit {{ $user->username }}</h4>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ old('username', $user->username) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="role"><strong>Role</strong></label>
                            <select class="default-select form-control wide mb-3" name="role" id="role" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
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
