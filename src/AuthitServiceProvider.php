<?php

namespace Naykel\Authit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;
use Naykel\Authit\Commands\ConfigCommand;
use Naykel\Authit\Commands\InstallCommand;
use Naykel\Authit\Commands\InstallMiddlewareCommand;
use Naykel\Authit\Livewire\User\UpdatePasswordForm;
use Naykel\Authit\Livewire\User\UpdateProfileForm;

class AuthitServiceProvider extends ServiceProvider
{
    public const REDIRECT_ROUTE = 'user.dashboard';

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/authit.php', 'authit');

        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('user.update-password-form', UpdatePasswordForm::class);
            Livewire::component('user.update-profile-form', UpdateProfileForm::class);
        });
    }

    public function boot(): void
    {

        $this->registerComponents();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authit');

        if ($this->app->runningInConsole()) {
            $this->commands([InstallCommand::class]);
            $this->commands([ConfigCommand::class]);
            $this->commands([InstallMiddlewareCommand::class]);

            $this->publishes([
                __DIR__ . '/../config/authit.php' => config_path('authit.php'),
            ], 'authit-config');
        }
    }

    protected function registerComponents()
    {
        $this->registerComponent('auth-header');

        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('account-dropdown');
        });
    }

    protected function registerComponent(string $component): void
    {
        Blade::component('authit::components.' . $component, 'authit-' . $component);
    }
}
