<?php

use Illuminate\Support\Facades\Route;
use Naykel\Authit\Http\Controllers\Auth\AuthenticatedSessionController;
use Naykel\Authit\Http\Controllers\Auth\ConfirmablePasswordController;
use Naykel\Authit\Http\Controllers\Auth\EmailVerificationNotificationController;
use Naykel\Authit\Http\Controllers\Auth\EmailVerificationPromptController;
use Naykel\Authit\Http\Controllers\Auth\NewPasswordController;
use Naykel\Authit\Http\Controllers\Auth\PasswordController;
use Naykel\Authit\Http\Controllers\Auth\PasswordResetLinkController;
use Naykel\Authit\Http\Controllers\Auth\RegisteredUserController;
use Naykel\Authit\Http\Controllers\Auth\VerifyEmailController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::middleware('web')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Guest User Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::middleware('guest')->group(function () {
        if (config('authit.registration_enabled')) {
            $registrationMiddleware = [
                ProtectAgainstSpam::class,
                'throttle:' . config('authit.registration_throttle', '3,10'),
            ];
            Route::get('register', [RegisteredUserController::class, 'create'])->middleware(ProtectAgainstSpam::class)->name('register');
            Route::post('register', [RegisteredUserController::class, 'store'])->middleware($registrationMiddleware);
        }

        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('throttle:5,1')->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->middleware('throttle:5,1')->name('password.store');
    });

    /*
    |--------------------------------------------------------------------------
    | Authenticated User Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        if (config('authit.registration_enabled')) {
            Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
            Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
            Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
            Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
            Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
            Route::put('password', [PasswordController::class, 'update'])->name('password.update');
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Verified User Routes
    |--------------------------------------------------------------------------
    |
    */
    // these should only be accessible if registration is enabled. However, this
    // would block admin users from accessing the user dashboard.
    Route::middleware(['auth', 'verified'])->prefix('user')->name('user')->group(function () {
        if (config('authit.registration_enabled')) {
            Route::view('/account', 'authit::user.account')->name('.account');
            Route::view('/dashboard', 'user.dashboard')->name('.dashboard');
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    | The assumption is if authit is installed, there will always be an admin.
    */
    Route::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('.dashboard');
    });
});
