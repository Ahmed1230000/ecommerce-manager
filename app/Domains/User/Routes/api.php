<?php

use App\Domains\User\Http\Controllers\AuthController;
use App\Domains\User\Http\Controllers\GetProfileController;
use App\Domains\User\Http\Controllers\ResetPasswordController;
use App\Domains\User\Http\Controllers\VerifyOtpForUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (no authentication required)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/password/forgot', [ResetPasswordController::class, 'sendResetLink']);
Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword']);

Route::group(['middleware' => 'throttle:3,1'], function () {
    Route::post('/verify', [VerifyOtpForUserController::class, 'verify']);
    Route::post('/resend-otp', [VerifyOtpForUserController::class, 'resend']);
});

/*
|--------------------------------------------------------------------------
| Protected Routes (authentication required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:api')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // ✅ Profile requires verified OTP
    Route::middleware('verified.otp')->group(function () {
        Route::get('/profile', [GetProfileController::class, 'show']);
    });
});
