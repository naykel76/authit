<?php

use Illuminate\Support\Facades\Route;
use Naykel\Authit\Http\Controllers\UserProfileController;

// no user params passed in, uses Auth::user()
Route::middleware(['web', 'auth'])->group(function () {

    // user routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/edit-account', [UserProfileController::class, 'edit'])->name('edit');
        Route::put('/profile-update', [UserProfileController::class, 'update'])->name('update');
        // Route::get('/dashboard', function () {
        //     return view(View::exists('users.dashboard') ? 'users.dashboard' : 'dashboard::users.dashboard')
        //         ->with('title', 'Student Dashboard');
        // })->name('dashboard');

        // return local view
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        // UserProfile
        //     Route::get('/{user}/profile/edit', 'User\UserProfileController@edit')->name('profile.edit');
        //     Route::patch('/{user}/profile/update', 'User\UserProfileController@update')->name('profile.update');
        //     // UserAvatarController
        //     Route::get('/{user}/avatar/edit', 'User\UserAvatarController@edit')->name('avatar.edit');
        //     Route::patch('/{user}/avatar/update', 'User\UserAvatarController@update')->name('avatar.update');

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
