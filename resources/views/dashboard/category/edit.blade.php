@extends('layouts.dashboard')

@section('title', 'Update category Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $cat->id) }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label for="name"><strong>Category Name</strong></label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $cat->name }}" required>
                            </div>
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
