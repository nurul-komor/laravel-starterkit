<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\Auth\UpdatePasswordController;
use App\Http\Controllers\Api\Auth\User\RegisterUserController;
use App\Http\Controllers\Api\Auth\User\DeleteAccountController;
use App\Http\Controllers\Api\Auth\User\GerUserProfileController;
use App\Http\Controllers\Api\Auth\User\UpdateUserProfileController;
use App\Http\Controllers\Api\Auth\EmailVerificationNotificationController;

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

Route::group(['middleware' => 'maintenance'], function () {

    /* -------------------------------------------------------------------------- */
    /*                            user register & login                           */
    /* -------------------------------------------------------------------------- */

    Route::group(['as' => 'api.auth'], function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::post('register', [RegisterUserController::class, 'register']);
    });

    /* -------------------------------------------------------------------------- */
    /*                         protected routes for users                         */
    /* -------------------------------------------------------------------------- */

    Route::group(['middleware' => 'jwt'], function () {

        /* -------------------------------------------------------------------------- */
        /*                         email verification for api                         */
        /* -------------------------------------------------------------------------- */

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1', 'guest_email']);
        Route::post('email/verify', VerifyEmailController::class)->middleware(['throttle:6,1', 'guest_email']);

        /* -------------------------------------------------------------------------- */
        /*                             account management                             */
        /* -------------------------------------------------------------------------- */
        Route::group(['middleware' => ['custom_verified'], 'as' => 'api.auth.'], function () {
            Route::get('/profile', [GerUserProfileController::class, 'profile']);
            Route::put('/update-profile', [UpdateUserProfileController::class, 'updateProfile']);
            Route::put('/password/update', [UpdatePasswordController::class, 'updatePassword']);
            Route::delete('/delete-account', [DeleteAccountController::class, 'deleteAccount']);
        });
        /* ------------------------------- for logout ------------------------------- */
        Route::post('/logout', [LogoutController::class, 'logout']);
    });
});