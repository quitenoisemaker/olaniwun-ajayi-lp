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
            Route::put('/{user}/toggle-activate', 'toggleActivate')->name('admin.user.toggleActivate');
            Route::post('/search', 'searchUsers')->name('users.search');
        });
    });


    // Project Routes
    Route::prefix('projects')->group(function () {
        Route::controller(AdminUserProjectController::class)->group(function () {
            Route::get('/', 'index')->name('admin.projects.index');
            Route::get('/create', 'create')->name('admin.projects.create');
            Route::post('/', 'store')->name('admin.projects.store');
            Route::get('/{project}/edit', 'edit')->name('admin.projects.edit');
            Route::put('/{project}', 'update')->name('admin.projects.update');
            Route::delete('/{project}', 'destroy')->name('admin.projects.destroy');

            // Task Routes
            Route::get('/{project}/tasks', 'showTasks')->name('admin.projects.tasks');
            Route::get('/{project}/tasks/create', 'createTask')->name('admin.projects.tasks.create');
            Route::post('/{project}/tasks', 'storeTask')->name('admin.projects.tasks.store');
            Route::get('/{project}/tasks/{task}/edit', 'editTask')->name('admin.projects.tasks.edit');
            Route::put('/{project}/tasks/{task}', 'updateTask')->name('admin.projects.tasks.update');
            Route::delete('/{project}/tasks/{task}', 'destroyTask')->name('admin.projects.tasks.destroy');
        });
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});
