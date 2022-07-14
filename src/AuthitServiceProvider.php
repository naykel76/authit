<?php

namespace Naykel\Authit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Naykel\Authit\Http\Livewire\User\Profile;
use Naykel\Authit\Http\Livewire\User\UpdatePasswordForm;

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

        $this->commands([
            InstallCommand::class,
            InstallLocalCommand::class
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views/user' => resource_path('views/user'),
        ], 'authit-views');


        $this->publishes([
            __DIR__ . '/../stubs/seeders' => database_path('seeders'),
        ], 'authit-permissions');
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
            // $this->registerComponent('account-icon-button');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component)
    {
        Blade::component('authit::components.' . $component, 'authit-' . $component);
    }
}
