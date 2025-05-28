@extends('layouts.dashboard')

@section('title', 'Inventory Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between align-items-center">
                    <h4 class="card-title">List of all inventories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>VENDOR</strong></th>
                                <th><strong>CATEGORY</strong></th>
                                <th><strong>PRODUCT</strong></th>
                                <th><strong>IMAGE</strong></th>
                                <th><strong>QUANTITY</strong></th>
                                {{-- <th><strong>COST PRICE</strong></th>
                                <th><strong>SELLING PRICE</strong></th> --}}
                                <th><strong>DESCRIPTION</strong></th>
                                <th><strong>DATE CREATED</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->category ? $item->category->name : 'No category' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . 'storage/' . $item->image))
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Image"
                                                class="rounded-circle" width="50" height="50"
                                                style="cursor: pointer;"
                                                onclick="showAvatarModal('{{ asset('storage/' . $item->image) }}')">
                                        @else
                                            <svg width="50" height="50" class="rounded bg-light"
                                                xmlns="http://www.w3.org/2000/svg" fill="#ccc" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 16.5V7.5c0-.6-.3-1.1-.8-1.4l-7.5-4.3a1.5 1.5 0 0 0-1.5 0L4 6.1A1.5 1.5 0 0 0 3.3 7v9.6c0 .6.3 1.1.8 1.4l7.5 4.3a1.5 1.5 0 0 0 1.5 0l7.5-4.3c.5-.3.8-.8.8-1.5ZM12 22V12M3.3 7L12 12l8.7-5" />
                                            </svg>
                                        @endif
                                    </td>

                                    <td>{{ $item->quantity }}</td>
                                    {{-- <td>{{ number_format($item->cost_price, 2) }}</td>
                                    <td>{{ number_format($item->selling_price, 2) }}</td> --}}
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    {{-- <td>
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
                                    </td> --}}
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
