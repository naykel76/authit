<?php

use Illuminate\Support\Facades\Route;
use Naykel\Authit\Http\Controllers\UserController;
use Naykel\Authit\Http\Livewire\Profile;
use Naykel\Authit\Http\Livewire\UpdatePasswordForm;


Route::middleware(['web', 'auth'])->group(function () {

    // user routes
    Route::prefix('user')->name('user.')->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit-account', [UserController::class, 'edit'])->name('edit');
        Route::get('/edit-profile', Profile::class); // livewire component
        Route::get('/update-password', UpdatePasswordForm::class); // livewire component

    });

    // admin routes
    // Route::middleware(['role:super|admin'])->prefix('admin')->name('admin.')->group(function () {
    //     Route::get('/', function () {
    //         return view('authit::admin.dashboard')->with([
    //             'title' => 'Administrator Dashboard'
    //         ]);
    //     })->name('dashboard');
    // });
});
