<?php

namespace Naykel\Authit;

use Illuminate\Support\ServiceProvider;

class AuthitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authit');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes(
            [
                __DIR__.'/database/Seeders' => './database/seeders',
                __DIR__.'/stubs/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
                __DIR__.'/stubs/Kernel.php' => app_path('Http/Kernel.php'),
                __DIR__.'/Models' => app_path('Models'),
                __DIR__.'/stubs/RouteServiceProvider.php' => app_path('Providers/RouteServiceProvider.php'),
                __DIR__.'/stubs/app.php' => config_path('app.php'),
                __DIR__.'/stubs/fortify.php' => config_path('fortify.php'),
            ],
            'authit-req'
        );
    }
}
