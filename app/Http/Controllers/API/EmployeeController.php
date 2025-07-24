<?php

namespace App\Http\Controllers\API;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::select(
            'employees.id',
            'employees.name AS employee_name',
            DB::raw('COALESCE(departments.name, \'N/A\') AS department_name')
        )
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $employees
        ], 200);
    }

    public function salaryExpenditure()
    {
        $departments = Department::select(
            'departments.id',
            'departments.name AS department_name',
            DB::raw('COALESCE(SUM(employees.salary), 0) AS total_salary')
        )
            ->leftJoin('employees', 'departments.id', '=', 'employees.department_id')
            ->groupBy('departments.id', 'departments.name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $departments
        ], 200);
    }

    public function multipleProjects()
    {
        $employees = Employee::select(
            'employees.id',
            'employees.name AS employee_name',
            DB::raw('COUNT(employee_projects.id) AS project_count')
        )
            ->join('employee_projects', 'employees.id', '=', 'employee_projects.employee_id')
            ->groupBy('employees.id', 'employees.name')
            ->having('project_count', '>', 1)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $employees
        ], 200);
    }
}
