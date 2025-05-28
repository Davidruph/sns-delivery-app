@extends('layouts.dashboard')

@section('title', 'Edit inventory Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit inventory</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.update', $inventory->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name"><strong>Product Name</strong></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $inventory->name) }}" required>
                            </div>

                            <div class="col-3">
                                <label for="category_id"><strong>Category</strong></label>
                                <select name="category_id" id="category_id" class="default-select form-control wide"
                                    required>
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $inventory->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2">
                                <label for="quantity"><strong>Quantity</strong></label>
                                <input type="number" name="quantity" id="quantity" class="form-control"
                                    value="{{ old('quantity', $inventory->quantity) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="cost_price"><strong>Cost Price</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        id="basic-addon1">{{ optional(Auth::user()->store)->store_currency_symbol }}</span>
                                    <input type="number" step="0.01" name="cost_price" id="cost_price"
                                        class="form-control" value="{{ old('cost_price', $inventory->cost_price) }}"
                                        required>
                                </div>
                            </div>

                            <div class="col">
                                <label for="selling_price"><strong>Selling Price</strong></label>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        id="basic-addon1">{{ optional(Auth::user()->store)->store_currency_symbol }}</span>
                                    <input type="number" step="0.01" name="selling_price" id="selling_price"
                                        class="form-control" value="{{ old('selling_price', $inventory->selling_price) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description"><strong>Description (optional)</strong></label>
                            <textarea rows="3" name="description" id="description" class="form-control">{{ old('description', $inventory->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image"><strong>Product Image (optional)</strong></label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if ($inventory->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $inventory->image) }}" alt="Current Image"
                                        style="max-height: 150px;">
                                </div>
                            @endif
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
