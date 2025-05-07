@extends('layouts.dashboard')

@section('title', 'Change password Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update-password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-1"><strong>Current Password</strong></label>
                            <input type="password" name="current_password" class="form-control"
                                placeholder="Enter your current password" required>
                        </div>

                        <div class="mb-3">
                            <label class="mb-1"><strong>New Password</strong></label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your new password" required>
                        </div>
                        <div class="mb-3">
                            <label class="mb-1"><strong>Confirm New Password</strong></label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm your new password" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
