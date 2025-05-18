@extends('layouts.dashboard')

@section('title', 'Store settings Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Store Settings</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="mb-1"><strong>Store Name</strong></label>
                            <input type="text" name="store_name" class="form-control" placeholder="Enter store name"
                                value="{{ old('store_name', $store->store_name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="logo"><strong>Logo</strong></label><br>
                            @if ($store?->store_logo)
                                <img src="{{ asset('storage/' . $store->store_logo) }}" alt="Current Logo" width="100"
                                    class="mb-2 rounded">
                            @endif
                            <input type="file" name="store_logo" id="logo" class="form-control">
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="mb-1"><strong>Store Phone</strong></label>
                                <input type="text" name="store_phone" class="form-control"
                                    value="{{ old('store_phone', $store->store_phone ?? '') }}"
                                    placeholder="Enter store phone" required>
                            </div>
                            <div class="col">
                                <label class="mb-1"><strong>Store Currency</strong></label>
                                <input type="text" name="store_currency" class="form-control"
                                    value="{{ old('store_currency', $store->store_currency ?? '') }}"
                                    placeholder="Currency (e.g., USD)" required>
                            </div>
                            <div class="col">
                                <label class="mb-1"><strong>Currency Symbol</strong></label>
                                <input type="text" name="store_currency_symbol" class="form-control"
                                    value="{{ old('store_currency_symbol', $store->store_currency_symbol ?? '') }}"
                                    placeholder="e.g., $" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="mb-1"><strong>Store Address</strong></label>
                            <textarea name="store_address" class="form-control" rows="3" required>{{ old('store_address', $store->store_address ?? '') }}</textarea>
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
