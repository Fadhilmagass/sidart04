<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permissions
        $permissions = [
            'manage users',
            'view announcements',
            'create announcements',
            'edit announcements',
            'delete announcements',
            'manage finances',
            'view finances',
            'manage forum',
            'participate forum',
            'view statistics'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Admin role and assign permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Create User role with limited permissions
        $userRole = Role::create(['name' => 'User']);
        $userRole->givePermissionTo([
            'view announcements',
            'participate forum',
            'view statistics'
        ]);
    }
}
