@extends('layouts.dashboard')

@section('title', 'User Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between align-items-center">
                    <h4 class="card-title">List of all new sign up requests</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>USERNAME</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>EMAIL</strong></th>
                                <th><strong>PHONE</strong></th>
                                <th><strong>ADDRESS</strong></th>
                                <th><strong>ROLE</strong></th>
                                <th><strong>STATUS</strong></th>
                                <th><strong>DATE CREATED</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->roles->first()->name ?? 'No role assigned' }}</td>
                                    <td>
                                        @if ($user->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($user->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif ($user->status === 'disabled')
                                            <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
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
                                                <a href="#" type="button" class="dropdown-item"
                                                    data-bs-toggle="modal" data-bs-target="#statusModal{{ $user->id }}">
                                                    Change status
                                                </a>

                                                @if ($user->id !== auth()->user()->id)
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                                            class="dropdown-item">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="statusModal{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <form action="{{ route('users.signup_request_status', $user->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Approve user</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                                    <div class="form-group">
                                                        <label for="user_status">Change User Status</label>
                                                        <select name="user_status" id="user_status"
                                                            class="mb-3 form-control wide" required
                                                            style="background: #311898">
                                                            <option value="">--Change status--</option>
                                                            <option value="pending"
                                                                {{ $user->status === 'pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="active"
                                                                {{ $user->status === 'active' ? 'selected' : '' }}>Active
                                                            </option>
                                                            <option value="disabled"
                                                                {{ $user->status === 'disabled' ? 'selected' : '' }}>
                                                                Disabled</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to approve this user?')"
                                                        class="btn btn-primary">Approve</button>
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


                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
