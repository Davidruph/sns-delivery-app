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
                    <form method="GET" action="{{ route('order.view.all') }}" class="mb-3 row g-3 align-items-end">
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
                            <a href="{{ route('order.view.all') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>

                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>EMAIL</strong></th>
                                <th><strong>ADDRESS</strong></th>
                                <th><strong>PHONE</strong></th>
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
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->phone }}</td>

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
                                                <a href="#" type="button" class="dropdown-item"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#statusModal{{ $order->id }}">
                                                    Change status
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="statusModal{{ $order->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <form action="{{ route('order.status', $order->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Change Order Status</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                    <div class="form-group">
                                                        <label for="order_status">Order Status</label>
                                                        <select name="order_status" id="order_status"
                                                            class="mb-3 form-control wide" required
                                                            style="background: #311898">
                                                            <option value="">--Select status--</option>
                                                            @foreach ($statuses as $status)
                                                                <option value="{{ $status }}"
                                                                    {{ $order->status === $status ? 'selected' : '' }}>
                                                                    {{ $status }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="remark">Remark</label>
                                                        <textarea name="remark" id="remark" class="form-control" rows="3" placeholder="Optional remark">{{ $order->remark }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to update the order status?')"
                                                        class="btn btn-primary">Update Status</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>

                    </table>


                    {{-- {{ $orders->links() }} --}}
                    {{ $orders->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
