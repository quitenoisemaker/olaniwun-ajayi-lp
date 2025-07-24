<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserProjectController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Admin User Management
    Route::resource('/admin/users', AdminUserController::class);
    Route::prefix('admin/users')->group(function () {
        Route::controller(AdminUserController::class)->group(function () {
            Route::put('/{user}/toggle-activate', 'toggleActivate')
                ->name('admin.user.toggleActivate');

            Route::post('/search', 'searchUsers')->name('users.search');
        });
    });


    // Route::resource('/admin/projects', AdminUserProjectController::class);
    // Project Routes
    Route::get('projects', [AdminUserProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('projects/create', [AdminUserProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('projects', [AdminUserProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('projects/{project}/edit', [AdminUserProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('projects/{project}', [AdminUserProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('projects/{project}', [AdminUserProjectController::class, 'destroy'])->name('admin.projects.destroy');

    // Task Routes
    Route::get('projects/{project}/tasks', [AdminUserProjectController::class, 'showTasks'])->name('admin.projects.tasks');
    Route::get('projects/{project}/tasks/create', [AdminUserProjectController::class, 'createTask'])->name('admin.projects.tasks.create');
    Route::post('projects/{project}/tasks', [AdminUserProjectController::class, 'storeTask'])->name('admin.projects.tasks.store');
    Route::get('projects/{project}/tasks/{task}/edit', [AdminUserProjectController::class, 'editTask'])->name('admin.projects.tasks.edit');
    Route::put('projects/{project}/tasks/{task}', [AdminUserProjectController::class, 'updateTask'])->name('admin.projects.tasks.update');
    Route::delete('projects/{project}/tasks/{task}', [AdminUserProjectController::class, 'destroyTask'])->name('admin.projects.tasks.destroy');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});
