<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'status' => 1,
            'is_superadmin' => 1,
            'last_login' => Carbon::now()->format('l jS \\of F Y h:i:s A'),
        ]);
        // assigning role
        $role = Role::where('name', 'superadmin')->get();
        $admin->assignRole($role);
    }
}
