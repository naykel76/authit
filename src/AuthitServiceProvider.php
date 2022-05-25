<?php

namespace Naykel\Authit;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Naykel\Authit\Http\Livewire\Avatar;
use Naykel\Authit\Http\Livewire\Profile;
use Naykel\Authit\Http\Livewire\UpdatePasswordForm;
use Livewire\Livewire;

class AuthitServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->afterResolving(BladeCompiler::class, function () {
            // Livewire Components...
            Livewire::component('update-password-form', UpdatePasswordForm::class);
            Livewire::component('avatar', Avatar::class);
            Livewire::component('profile', Profile::class);
        });
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authit');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->commands([
            InstallCommand::class,
        ]);

    }
}
