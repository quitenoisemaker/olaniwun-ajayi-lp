<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'User Example',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => getRole(Role::USER)->id
        ]);

        // You can create more users as needed
        User::create([
            'name' => 'User Example 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'role_id' => getRole(Role::USER)->id
        ]);

        User::create([
            'name' => 'User Example 3',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
            'role_id' => getRole(Role::USER)->id
        ]);
    }
}
