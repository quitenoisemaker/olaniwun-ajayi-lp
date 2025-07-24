<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Sample projects
        Project::create([
            'title' => 'Website Redesign',
            'description' => 'Redesign the company website with a modern look.',
        ]);

        Project::create([
            'title' => 'Mobile App Development',
            'description' => 'Develop a mobile app for customer engagement.'
        ]);
    }
}
