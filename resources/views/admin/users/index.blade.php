@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif

                <div class="mb-3">
                    <form id="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" required name="search_user" id="searchUser" placeholder="Search by name, email or role">
                            <div class="input-group-append">
                                <button type="submit" id="search-btn" class="btn btn-primary">Search</button>
                                <button type="button" class="btn btn-outline-primary" onclick="location.reload()">Refresh</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('User Management') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date created</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="search-body">
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role ? $user->role->name : 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('admin.user.toggleActivate', $user->id) }}" style="display: inline-block;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
                                                        <button type="submit" class="btn btn-{{ $user->is_active ? 'danger' : 'warning' }} btn-sm m-1">
                                                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="no-data" class="text-center"><td colspan="5">No user found</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@include('admin.users.script')
@endsection