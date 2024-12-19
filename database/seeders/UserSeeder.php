<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Create Regular User Role
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // Change this to a secure password
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // Create Regular User
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => bcrypt('password'), // Change this to a secure password
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole($userRole);
    }
}
