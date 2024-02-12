<?php

namespace Naykel\Authit;

use Naykel\Authit\Livewire\User\UpdatePasswordForm;
use Naykel\Authit\Livewire\User\UpdateProfileFrom;
use Illuminate\View\Compilers\BladeCompiler;
use Naykel\Authit\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class AuthitServiceProvider extends ServiceProvider
{
    public const ADMIN_DASHBOARD = '/admin';
    public const USER_DASHBOARD = '/user/account';

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
