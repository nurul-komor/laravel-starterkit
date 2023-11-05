<?php
// need
namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use App\Models\DatabaseTableBackup;

class GetDbBackupController extends Controller
{
    // getDatabaseBackup
    public function getDatabaseBackup()
    {
        $backups = DatabaseTableBackup::latest()->get();
        foreach ($backups as $backup) {
            $backup['link'] = storage_path('/app/backups/' . $backup->file_name);
        }

        return response()->json([
            'status' => true,
            'backups' => $backups,
        ]);
    }
}