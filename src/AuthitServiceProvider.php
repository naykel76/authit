<?php

namespace Naykel\Authit;

use Naykel\Authit\Http\Livewire\User\UpdatePasswordForm;
use Naykel\Authit\Commands\InstallLocalCommand;
use Naykel\Authit\Http\Livewire\User\Profile;
use Illuminate\View\Compilers\BladeCompiler;
use Naykel\Authit\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
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

        $this->configureComponents();

        $this->commands([InstallCommand::class, InstallLocalCommand::class]);

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
