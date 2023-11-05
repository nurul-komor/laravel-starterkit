<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the permissions for the admin guard
        $permissions = [
            'user view',
            'user create',
            'user edit',
            'user delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'user']);
        }
        $role = Role::create(['name' => 'student', 'guard_name' => 'user']);
        $role->syncPermissions($permissions);
    }
}