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

    Route::resource('/admin/users', AdminUserController::class);
    Route::prefix('admin/users')->group(function () {
        Route::controller(AdminUserController::class)->group(function () {
            Route::put('/{user}/toggle-activate', 'toggleActivate')
                ->name('admin.user.toggleActivate');

            Route::post('/search', 'searchUsers')->name('users.search');
        });
    });


    Route::resource('/admin/projects', AdminUserProjectController::class);
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});
