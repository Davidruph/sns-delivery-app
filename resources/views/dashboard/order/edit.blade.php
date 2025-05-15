@extends('layouts.dashboard')

@section('title', 'Edit Order Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Order</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf

                        <div id="product-container">
                            @foreach ($order->items as $item)
                                <div class="row mb-2 product-row">
                                    <input type="hidden" name="item_ids[]" value="{{ $item->id }}">
                                    <div class="col">
                                        <label><strong>Select Product</strong></label>
                                        <select name="product[]" class="default-select form-control wide" required>
                                            <option value="">-- Select Product --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ $product->id == $item->inventory_id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label><strong>Quantity</strong></label>
                                        <input type="number" name="quantity[]" class="form-control"
                                            value="{{ $item->quantity }}" required>
                                    </div>
                                    <div class="col-3">
                                        <label><strong>Amount/Price</strong></label>
                                        <input type="number" name="amount[]" class="form-control"
                                            value="{{ $item->amount }}" required>
                                    </div>
                                    <div class="col-2">
                                        <label><strong>&nbsp;</strong></label>
                                        <button type="button" class="btn btn-danger remove-row w-100">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row mt-3">
                            <div class="col text-end mb-3">
                                <button type="button" class="btn btn-success add-row">Add Product</button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="coL">
                                <label for="address"><strong>Address</strong></label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ $order->address }}" required>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Update Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Clone Row Template (hidden) --}}
    <div id="product-row-template" class="d-none">
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
                <label><strong>Amount/Price</strong></label>
                <input type="number" name="amount[]" class="form-control" required>
            </div>
            <div class="col-2">
                <label><strong>&nbsp;</strong></label>
                <button type="button" class="btn btn-danger remove-row w-100">Remove</button>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('.add-row').addEventListener('click', function() {
            const template = document.getElementById('product-row-template').innerHTML;
            document.getElementById('product-container').insertAdjacentHTML('beforeend', template);
        });

        document.getElementById('product-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('.product-row').remove();
            }
        });
    });
</script>
