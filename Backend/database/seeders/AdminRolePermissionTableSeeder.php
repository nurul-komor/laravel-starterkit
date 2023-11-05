<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminRolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the permissions for the admin guard
        $permissions = [
            'admin view',
            'admin create',
            'admin edit',
            'admin delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);
        }
        $role = Role::create(['name' => 'student', 'guard_name' => 'admin']);
        $role->syncPermissions($permissions);
    }
}
