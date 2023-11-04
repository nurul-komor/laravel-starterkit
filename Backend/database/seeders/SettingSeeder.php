<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'site_title' => 'Your Site Title',
            'favicon' => 'path/to/favicon.png',
            'site_logo' => 'path/to/logo.png',
            'footer_text' => 'Your footer text',
            'contact_phone' => '123-456-7890',
            'contact_email' => 'contact@example.com',
            'contact_address' => '123 Main St, City, Country',
            'email_verification' => 0,
            'maintenance_mode' => 0,
            // 0 for off, 1 for on
        ]);
    }
}
