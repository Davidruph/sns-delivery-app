@extends('layouts.dashboard')

@section('title', 'Create inventory Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create a new inventory</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name"><strong>Product Name</strong></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="col-3">
                                <label for="category"><strong>Category</strong></label>
                                <select name="category" id="category" class="default-select form-control wide" required>
                                    <option value="">-- Select Category --</option>
                                    <option value="electronics" {{ old('category') === 'electronics' ? 'selected' : '' }}>
                                        Electronics</option>
                                    <option value="furniture" {{ old('category') === 'furniture' ? 'selected' : '' }}>
                                        Furniture
                                    </option>
                                    <option value="office_supplies"
                                        {{ old('category') === 'office_supplies' ? 'selected' : '' }}>Office Supplies
                                    </option>
                                    <option value="stationery" {{ old('category') === 'stationery' ? 'selected' : '' }}>
                                        Stationery</option>
                                    <option value="tools_equipment"
                                        {{ old('category') === 'tools_equipment' ? 'selected' : '' }}>Tools & Equipment
                                    </option>
                                    <option value="cleaning_supplies"
                                        {{ old('category') === 'cleaning_supplies' ? 'selected' : '' }}>Cleaning Supplies
                                    </option>
                                    <option value="raw_materials"
                                        {{ old('category') === 'raw_materials' ? 'selected' : '' }}>
                                        Raw Materials</option>
                                    <option value="finished_goods"
                                        {{ old('category') === 'finished_goods' ? 'selected' : '' }}>
                                        Finished Goods</option>
                                    <option value="food_beverages"
                                        {{ old('category') === 'food_beverages' ? 'selected' : '' }}>Food & Beverages
                                    </option>
                                    <option value="medical_supplies"
                                        {{ old('category') === 'medical_supplies' ? 'selected' : '' }}>Medical Supplies
                                    </option>
                                </select>
                            </div>

                            <div class="col-2">
                                <label for="quantity"><strong>Quantity</strong></label>
                                <input type="number" name="quantity" id="quantity" class="form-control"
                                    value="{{ old('quantity') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="cost_price"><strong>Cost Price</strong></label>
                                <input type="number" step="0.01" name="cost_price" id="cost_price" class="form-control"
                                    value="{{ old('cost_price') }}" required>
                            </div>

                            <div class="col">
                                <label for="selling_price"><strong>Selling Price</strong></label>
                                <input type="number" step="0.01" name="selling_price" id="selling_price"
                                    class="form-control" value="{{ old('selling_price') }}" required>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="description"><strong>Description (optional)</strong></label>
                            <textarea rows="3" name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image"><strong>Product Image (optional)</strong></label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                required>
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
