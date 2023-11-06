<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Helpers\ArtisanController;
use App\Http\Controllers\Helpers\GetDbBackupController;
use App\Http\Controllers\RolePermissionCheckerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */


/* -------------------------------------------------------------------------- */
/*                        Permission checker controller                       */
/* -------------------------------------------------------------------------- */


Route::get('/checkPermission', RolePermissionCheckerController::class);


// helper db backup

// Admin Routes
Route::group(['middleware' => 'jwt:admin', 'prefix' => '/admin'], function () {
    Route::get('/site/optimize', [ArtisanController::class, 'siteOptimize']);
    Route::get('/site/clear-database', [ArtisanController::class, 'clearDatabase']);

    Route::get('/database/backup/crete', [ArtisanController::class, 'databaseBackup']);
    Route::get('/database/backups/get', [GetDbBackupController::class, 'getDatabaseBackup']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
