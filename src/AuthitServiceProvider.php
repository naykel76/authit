<?php

namespace Naykel\Authit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Naykel\Authit\Commands\InstallCommand;
use Naykel\Authit\Livewire\User\UpdatePasswordForm;
use Naykel\Authit\Livewire\User\UpdateProfileFrom;

class AuthitServiceProvider extends ServiceProvider
{
    // NK::TD need to give this some more thought because it may need to be dynamic
    public const REDIRECT_ROUTE = 'user.dashboard';

    public function register()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('user.update-password-form', UpdatePasswordForm::class);
            Livewire::component('user.update-profile-form', UpdateProfileFrom::class);
        });

        $this->mergeConfigFrom(__DIR__ . '/config/authit.php', 'authit');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authit');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->configureComponents();

        $this->commands([InstallCommand::class]);

        $this->publishes([
            __DIR__ . '/config/authit.php' => config_path('authit.php'),
        ], 'authit-config');

        $this->publishes([
            __DIR__ . '/../resources/views/user' => resource_path('views/user'),
        ], 'authit-views');

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'authit-seeders');
    }

    /**
     * Configure the Gotime Blade components.
     *
     * @return void
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('account-dropdown');
        });
    }

    /**
     * Register the given component.
     */
    protected function registerComponent(string $component): void
    {
        Blade::component('authit::components.' . $component, 'authit-' . $component);
    }
}
