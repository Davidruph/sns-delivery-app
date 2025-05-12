@extends('layouts.dashboard')

@section('title', 'Store orders Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Order</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-5">
                                <label for="name"><strong>Name</strong></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}" readonly required>
                            </div>
                            <div class="col-4">
                                <label for="email"><strong>Email</strong></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}" readonly required>
                            </div>
                            <div class="col">
                                <label for="phone"><strong>Phone</strong></label>
                                <input type="text" name="phone" id="phone" readonly class="form-control"
                                    value="{{ $user->phone }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="coL">
                                <label for="address"><strong>Address</strong></label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ $user->address }}" required>
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
