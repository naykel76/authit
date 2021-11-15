<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Naykel\Authit\Http\Controllers\UserProfileController;


Route::middleware(['web', 'auth'])->group(function () {

    // user routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/edit-account', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('/profile-update', [UserProfileController::class, 'update'])->name('update');
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        Route::get('/logout', function (Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        })->name('logout');
    });



    // admin routes
    // add local routes to override
    Route::middleware(['role:super|admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('authit::admin.dashboard')->with([
                'title' => 'Administrator Dashboard'
            ]);
        })->name('dashboard');
    });
});
