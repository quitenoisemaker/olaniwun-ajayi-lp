<?php

namespace Database\Seeders;

use App\Models\EmployeeProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $projects = [
            ['project_name' => 'CMS Upgrade', 'employee_id' => 2],
            ['project_name' => 'Data Migration', 'employee_id' => 3],
            ['project_name' => 'Budget Review', 'employee_id' => 4],
            ['project_name' => 'Internal Audit', 'employee_id' => 4],
            ['project_name' => 'Security Enhancement', 'employee_id' => 3],
            ['project_name' => 'Legal Case Automation', 'employee_id' => 1],
            ['project_name' => 'Compliance Tracker', 'employee_id' => 1],
        ];

        EmployeeProject::insert($projects);
    }
}
