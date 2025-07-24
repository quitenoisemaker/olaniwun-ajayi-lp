<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $employees = [
            ['name' => 'Alice Johnson', 'department_id' => 1, 'salary' => 60000],
            ['name' => 'Bob Smith', 'department_id' => 2, 'salary' => 75000],
            ['name' => 'Charlie Daniels', 'department_id' => 2, 'salary' => 80000],
            ['name' => 'Diana Ross', 'department_id' => 3, 'salary' => 50000],
            ['name' => 'Ethan Ray', 'department_id' => 1, 'salary' => 62000],
            ['name' => 'Fiona Lee', 'department_id' => 3, 'salary' => 55000],
        ];

        Employee::insert($employees);
    }
}
