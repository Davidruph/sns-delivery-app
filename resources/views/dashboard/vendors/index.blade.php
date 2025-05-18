@extends('layouts.dashboard')

@section('title', 'User Page')

@section('content')
    @include('alerts.index')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between align-items-center">
                    <h4 class="card-title">List of all Vendors</h4>
                    <a href="{{ route('vendors.create') }}" class="btn btn-secondary">Create a Vendor</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width:80px;"><strong>#</strong></th>
                                <th><strong>AVATAR</strong></th>
                                <th><strong>USERNAME</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>EMAIL</strong></th>
                                <th><strong>PHONE</strong></th>
                                <th><strong>ADDRESS</strong></th>
                                <th><strong>ROLE</strong></th>
                                <th><strong>DATE CREATED</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendors as $user)
                                <tr>
                                    <td><strong>{{ $loop->iteration }}</strong></td>
                                    <td>
                                        @if ($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                                class="rounded-circle" width="50" height="50"
                                                style="cursor: pointer;"
                                                onclick="showAvatarModal('{{ asset('storage/' . $user->avatar) }}')">
                                        @else
                                            <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="rounded-circle bg-secondary text-white">
                                                <circle cx="12" cy="12" r="12" fill="#ccc" />
                                                <path
                                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4 -4 1.79-4 4 1.79 4 4 4zM12 14c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                                                    fill="#fff" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->roles->first()->name ?? 'No role assigned' }}</td>
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
                                                <a class="dropdown-item"
                                                    href="{{ route('vendors.edit', $user->id) }}">Edit</a>

                                                @if ($user->id !== auth()->user()->id)
                                                    <form action="{{ route('vendors.destroy', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this vendor?')"
                                                            class="dropdown-item">Delete</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
