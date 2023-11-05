<?php
// need
namespace App\Http\Controllers\Api\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    // Website Optimize
    public function siteOptimize()
    {
        Artisan::call('optimize:clear');

        return response()->json([
            'status' => true,
            'message' => 'This site successfully optimized now',
        ]);
    }

    // clearDatabase
    public function clearDatabase()
    {
        Artisan::call('migrate:fresh --seed');

        return response()->json([
            'status' => true,
            'message' => 'Database successfully cleared and dummy data inserted.',
        ]);
    }

    // databaseBackup
    public function databaseBackup()
    {
        Artisan::call('dbsql:backup');

        return response()->json([
            'status' => true,
            'message' => 'Database Backup successfully created.',
        ]);
    }
}