@extends('layouts.dashboard')

@section('title', 'Inventory Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between align-items-center">
                    <h4 class="card-title">List of my inventories</h4>
                    @if (auth()->user()->getRoleNames()->first() === 'Vendor')
                        <a href="{{ route('inventory.create') }}" class="btn btn-secondary">Create Inventory</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>IMAGE</strong></th>
                                <th><strong>QUANTITY</strong></th>
                                <th><strong>COST PRICE</strong></th>
                                <th><strong>SELLING PRICE</strong></th>
                                <th><strong>DESCRIPTION</strong></th>
                                <th><strong>DATE CREATED</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="Image"
                                            class="rounded-circle" width="50" height="50">
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->cost_price }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp"
                                                data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <circle fill="#000000" cx="5" cy="12" r="2" />
                                                        <circle fill="#000000" cx="12" cy="12" r="2" />
                                                        <circle fill="#000000" cx="19" cy="12" r="2" />
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('inventory.edit', $item->id) }}">Edit</a>

                                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                                        class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    {{ $inventory->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
