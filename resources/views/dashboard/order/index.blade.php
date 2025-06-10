@extends('layouts.dashboard')

@section('title', 'Store orders Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between align-items-center">
                    <h4 class="card-title">List of Orders</h4>
                    @if (auth()->user()->getRoleNames()->first() === 'Vendor')
                        <a href="{{ route('order.create') }}" class="btn btn-secondary">Create Order</a>
                    @endif
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('order.index') }}" class="mb-3 row g-3 align-items-end">
                        <div class="col-auto">
                            <select name="filter" class="default-select form-control wide">
                                <option value="">-- Filter By --</option>
                                <option value="week" {{ request('filter') === 'week' ? 'selected' : '' }}>This Week
                                </option>
                                <option value="month" {{ request('filter') === 'month' ? 'selected' : '' }}>This Month
                                </option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="from" class="form-control" value="{{ request('from') }}"
                                placeholder="From date">
                        </div>
                        <div class="col-auto">
                            <input type="date" name="to" class="form-control" value="{{ request('to') }}"
                                placeholder="To date">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Apply Filter</button>
                            <a href="{{ route('order.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>FULL NAME</strong></th>
                                {{-- <th><strong>EMAIL</strong></th> --}}
                                <th><strong>PHONE</strong></th>
                                <th><strong>ADDRESS</strong></th>
                                <th><strong>PRODUCT</strong></th>
                                <th><strong>QTY</strong></th>
                                <th><strong>AMOUNT</strong></th>
                                <th><strong>DATE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th><strong>REMARK</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $order->name }}</td>
                                    {{-- <td>{{ $order->email }}</td> --}}
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->address }}</td>

                                    {{-- Product column --}}
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->items as $item)
                                                <li>{{ $loop->iteration }}. {{ $item->inventory->name ?? 'N/A' }}</li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    {{-- Quantity column --}}
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->items as $item)
                                                <li>{{ $item->quantity }}</li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    {{-- Amount column --}}
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($order->items as $item)
                                                <li>{{ Auth::user()->store->store_currency_symbol . ' ' . number_format($item->amount, 2) }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->remark }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-success light sharp"
                                                data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24">
                                                    <g fill="none">
                                                        <circle fill="#000000" cx="5" cy="12" r="2" />
                                                        <circle fill="#000000" cx="12" cy="12" r="2" />
                                                        <circle fill="#000000" cx="19" cy="12" r="2" />
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('order.edit', $order->id) }}">Edit</a>
                                                <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this order?')"
                                                        class="dropdown-item">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
