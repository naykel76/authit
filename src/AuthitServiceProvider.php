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
            // Livewire::component('navigation-menu', NavigationMenu::class);
            // Livewire::component('profile.update-profile-information-form', UpdateProfileInformationForm::class);
            // Livewire::component('profile.update-password-form', UpdatePasswordForm::class);
            // Livewire::component('profile.two-factor-authentication-form', TwoFactorAuthenticationForm::class);
            // Livewire::component('profile.logout-other-browser-sessions-form', LogoutOtherBrowserSessionsForm::class);
            // Livewire::component('profile.delete-user-form', DeleteUserForm::class);


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


        // $this->publishes(
        //     [
        //         __DIR__.'/database/Seeders' => './database/seeders',
        //         __DIR__.'/stubs/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
        //         __DIR__.'/stubs/Kernel.php' => app_path('Http/Kernel.php'),
        //         __DIR__.'/Models' => app_path('Models'),
        //         __DIR__.'/stubs/RouteServiceProvider.php' => app_path('Providers/RouteServiceProvider.php'),
        //         __DIR__.'/stubs/app.php' => config_path('app.php'),
        //         __DIR__.'/stubs/fortify.php' => config_path('fortify.php'),
        //     ],
        //     'authit-req'
        // );
        // $this->publishes(
        //     [
        //         __DIR__.'/database/Seeders' => './database/seeders',
        //         __DIR__.'/stubs/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
        //         __DIR__.'/stubs/Kernel.php' => app_path('Http/Kernel.php'),
        //         __DIR__.'/Models' => app_path('Models'),
        //         __DIR__.'/stubs/RouteServiceProvider.php' => app_path('Providers/RouteServiceProvider.php'),
        //         __DIR__.'/stubs/app.php' => config_path('app.php'),
        //         __DIR__.'/stubs/fortify.php' => config_path('fortify.php'),
        //     ],
        //     'authit-seeders'
        // );


    }
}
