<?php

use App\Http\Controllers\Api\Helpers\ArtisanController;
use App\Http\Controllers\Helpers\GetDbBackupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Admin Routes
Route::group(['middleware' => 'jwt:admin', 'prefix' => '/admin'], function () {
    Route::delete('/adminuserdelete/{id}', [AdminController::class, 'AdminUserDelete']);
    Route::get('/allusers', [AdminController::class, 'AllUsers']);
    Route::get('/useredit/{id}', [AdminController::class, 'UserEdit']);
    Route::put('/usersupdate/{id}', [AdminController::class, 'UserUpdate']);

    // user management
    Route::get('/admin-users', [AdminController::class, 'AdminUser']);

});