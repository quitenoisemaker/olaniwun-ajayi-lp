@extends('layouts.app-admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Task for Project: ' . $project->title) }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.projects.tasks.update', [$project->id, $task->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Task Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description', $task->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="assigned_user_id">Assigned User</label>
                                <select name="assigned_user_id" id="assigned_user_id" class="form-control">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_user_id', $task->assigned_user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="is_completed">Status</label>
                                <select name="is_completed" id="is_completed" class="form-control">
                                    <option value="0" {{ old('is_completed', $task->is_completed) == 0 ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ old('is_completed', $task->is_completed) == 1 ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <button type="submit" class="btn btn-primary">Update Task</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('admin.projects.tasks', $project->id) }}" class="btn btn-secondary mt-3">Back to Tasks</a>
            </div>
        </div>
    </div>
@endsection