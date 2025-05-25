@extends('layouts.dashboard')

@section('title', 'Order create Page')

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

                        <div id="product-container">
                            <div class="row mb-2 product-row">
                                <div class="col">
                                    <label><strong>Select Product</strong></label>
                                    <select name="product[]" class="default-select form-control wide" required>
                                        <option value="">-- Select Product --</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label><strong>Quantity</strong></label>
                                    <input type="number" name="quantity[]" class="form-control" required>
                                </div>
                                <div class="col-3">
                                    <label>
                                        <strong>Amount/Price in
                                            {{ optional(Auth::user()->store)->store_currency }}
                                        </strong></label>

                                    <div class="input-group">
                                        <span class="input-group-text"
                                            id="basic-addon1">{{ optional(Auth::user()->store)->store_currency_symbol }}</span>
                                        <input type="number" name="amount[]" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label><strong>&nbsp;</strong></label>
                                    <button type="button" class="btn btn-success add-row w-100">Add</button>
                                </div>
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
