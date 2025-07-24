<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\ProjectRequest;

class AdminUserProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['tasks'])->latest()->paginate(config('app.paginate_number'));
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(ProjectRequest $request)
    {
        Project::create($request->validated());
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function showTasks(Project $project)
    {
        $tasks = $project->tasks()->with('assignedUser')->get();
        return view('admin.projects.tasks.index', compact('project', 'tasks'));
    }

    public function createTask(Project $project)
    {
        $users = User::getActiveUsers()->get();
        return view('admin.projects.tasks.create', compact('project', 'users'));
    }

    public function storeTask(TaskRequest $request, Project $project)
    {
        $project->tasks()->create($request->validated());
        return redirect()->route('admin.projects.tasks', $project->id)->with('success', 'Task created successfully.');
    }

    public function editTask(Project $project, Task $task)
    {
        $users = User::getActiveUsers()->get();
        return view('admin.projects.tasks.edit', compact('project', 'task', 'users'));
    }

    public function updateTask(TaskRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('admin.projects.tasks', $project->id)->with('success', 'Task updated successfully.');
    }

    public function destroyTask(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->route('admin.projects.tasks', $project->id)->with('success', 'Task deleted successfully.');
    }
}
