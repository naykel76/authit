<?php

use Naykel\Authit\Http\Controllers\Auth\AuthenticatedSessionController;
use Naykel\Authit\Http\Controllers\Auth\ConfirmablePasswordController;
use Naykel\Authit\Http\Controllers\Auth\EmailVerificationNotificationController;
use Naykel\Authit\Http\Controllers\Auth\EmailVerificationPromptController;
use Naykel\Authit\Http\Controllers\Auth\NewPasswordController;
use Naykel\Authit\Http\Controllers\Auth\PasswordResetLinkController;
use Naykel\Authit\Http\Controllers\Auth\RegisterUserController;
use Naykel\Authit\Http\Controllers\Auth\VerifyEmailController;
use Naykel\Authit\Http\Controllers\UserController;
use Naykel\Authit\Http\Livewire\Profile;
use Naykel\Authit\Http\Livewire\UpdatePasswordForm;

use Spatie\Honeypot\ProtectAgainstSpam;

// guest users
Route::middleware('web', 'guest')->group(function () {

    Route::get('register', [RegisterUserController::class, 'create'])->middleware(ProtectAgainstSpam::class)->name('register');
    Route::post('register', [RegisterUserController::class, 'store'])->middleware(ProtectAgainstSpam::class);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// authenticated and verified users
Route::middleware(['web', 'auth', 'verified'])->prefix('user')->name('user')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('.dashboard');
    // Route::get('/edit-account', [UserController::class, 'edit'])->name('.edit');
    Route::get('/edit-profile', Profile::class)->name('.edit-password'); // livewire component
    Route::get('/update-password', UpdatePasswordForm::class)->name('.update-password'); // livewire component

});

// authenticated users
Route::middleware(['web', 'auth'])->group(function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
