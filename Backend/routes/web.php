<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




/* -------------------------------------------------------------------------- */
/*                        email verification for blade                        */
/* -------------------------------------------------------------------------- */

// Route::get('verify-email', EmailVerificationPromptController::class)
//     ->name('verification.notice');

// Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//     ->middleware(['signed', 'throttle:6,1'])
//     ->name('verification.verify');

// Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//     ->middleware('throttle:6,1')
//     ->name('verification.send');