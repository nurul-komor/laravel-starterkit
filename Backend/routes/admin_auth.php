<?php

use App\Http\Controllers\Api\Auth\Admin\DeleteAccountController;
use App\Http\Controllers\Api\Auth\Admin\GetAdminProfileController;
use App\Http\Controllers\Api\Auth\Admin\RegisterAdminController;
use App\Http\Controllers\Api\Auth\Admin\UpdateAdminProfileController;
use App\Http\Controllers\Api\Auth\Admin\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
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

// Admin Routes
Route::post('/admin/login/', [LoginController::class, 'login']);

Route::group(['middleware' => 'jwt:admin', 'prefix' => '/admin'], function () {
    Route::post('/register', [RegisterAdminController::class, 'register']);
    Route::get('/profile', [GetAdminProfileController::class, 'profile']);
    Route::put('/profile/update', [UpdateAdminProfileController::class, 'updateProfile']);
    Route::put('/password/update', [UpdatePasswordController::class, 'updatePassword']);
    Route::delete('/delete-account', [DeleteAccountController::class, 'deleteProfile']);
    Route::post('/logout', [LogoutController::class, 'Logout']);
});

// Route::post('user/forget-password', [AuthController::class, 'ForgetPassword']);
// Route::post('sendEmail', [MailController::class, 'sendEmail']);
// Route::post('sendPasswordResetLink', [PasswordResetRequestController::class, 'sendEmail']);
// Route::put('response-password-reset', [ResetPasswordController::class, 'updatePassword']);