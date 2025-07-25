<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         \App\Models\Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
        \App\Models\Role::updateOrCreate([
            'name' => 'User',
            'slug' => 'user',
        ]);
    }
}
