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

                <div class="card">
                    <div class="card-header">{{ __('Tasks for Project: ' . $project->title) }}</div>
                    <div class="card-body">
                        <a href="{{ route('admin.projects.tasks.create', $project->id) }}" class="btn btn-success mb-3">Create New Task</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Assigned User</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($tasks->count() > 0)
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->title }}</td>
                                                <td>{{ $task->description ?? 'N/A' }}</td>
                                                <td>{{ $task->assignedUser ? $task->assignedUser->name : 'N/A' }}</td>
                                                <td>{{ $task->is_completed ? 'Completed' : 'Pending' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.projects.tasks.edit', [$project->id, $task->id]) }}" class="btn btn-info btn-sm">Edit</a>
                                                    <form method="POST" action="{{ route('admin.projects.tasks.destroy', [$project->id, $task->id]) }}" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm m-1" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center"><td colspan="5">No tasks found</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-3">Back to Projects</a>
            </div>
        </div>
    </div>
@endsection