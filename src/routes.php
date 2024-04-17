<?php

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
use Illuminate\Support\Facades\Route;

// guest users
Route::middleware(['web', 'guest'])->group(function () {

    $enableRegistration = config('authit.allow_register');

    if ($enableRegistration) {
        Route::get('register', [RegisteredUserController::class, 'create'])->middleware(ProtectAgainstSpam::class)->name('register');
        Route::post('register', [RegisteredUserController::class, 'store'])->middleware(ProtectAgainstSpam::class);
    }

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// user routes
Route::middleware(['web', 'auth', 'verified'])->prefix('user')->name('user')->group(function () {
    Route::view('/account', 'authit::user.account')->name('.account');
    // dashboard route is handled locally
});

Route::middleware(['web', 'auth'])->group(function () {

    $enableRegistration = config('authit.allow_register');

    if ($enableRegistration) {
        Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    }
});
