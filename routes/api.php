<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index'])->name('api.employees.index');
    Route::get('departments/salary', [EmployeeController::class, 'salaryExpenditure'])->name('api.departments.salary');
    Route::get('employees/multiple-projects', [EmployeeController::class, 'multipleProjects'])->name('api.employees.multiple-projects');
});
