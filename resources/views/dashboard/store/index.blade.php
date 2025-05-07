@extends('layouts.dashboard')

@section('title', 'Store settings Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="mb-1"><strong>Store Name</strong></label>
                            <input type="text" name="store_name" class="form-control" placeholder="Enter store name"
                                required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
