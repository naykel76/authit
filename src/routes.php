<?php

use Illuminate\Support\Facades\Route;
use Naykel\Authit\Http\Controllers\UserProfileController;

// no user params passed in, uses Auth::user()
Route::middleware(['web', 'auth'])->group(function () {

    // user routes
    Route::prefix('user')->name('user')->group(function () {
        Route::get('/dashboard', [UserProfileController::class, 'dashboard'])->name('.dashboard');
        Route::put('/profile-update', [UserProfileController::class, 'update'])->name('.profile-update');
        Route::get('/profile-show', [UserProfileController::class, 'show'])->name('.profile-show');
    });

    // admin routes
    Route::middleware(['role:super|admin'])->prefix('admin')->name('admin')->group(function () {

        Route::get('/', function () {
            return view('authit::admin.dashboard');
        });
    });
});
