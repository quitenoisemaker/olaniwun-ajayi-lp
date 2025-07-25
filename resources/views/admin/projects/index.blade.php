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
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-success mt-2">Create New Project</a>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Project Management') }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Tasks</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="search-body">
                                    @if ($projects->count() > 0)
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td>{{ $project->title }}</td>
                                                <td>{{ $project->description ?? 'N/A' }}</td>
                                                <td><a href="{{ route('admin.projects.tasks', $project->id) }}" class="btn btn-success btn-sm">View Tasks ({{ $project->tasks->count() }})</a></td>
                                                <td>
                                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="no-data" class="text-center"><td colspan="5">No projects found</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
