<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Naykel\Gotime\Facades\FileManagement as FMS;

class InstallCommand extends Command
{
    protected $signature = 'authit:install';
    protected $description = 'Install Authit resources';

    public function handle()
    {
        $this->handlePermissions();
        $this->handleAdminDashboard();
        $this->handleUserDashboard();

        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/navs', resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/components', resource_path('views/components'));

        $this->info('Authit installed successfully!');
        $this->info('To enable split name fields, publish the config and set split_name_fields to true.');

        return Command::SUCCESS;
    }

    public function handlePermissions()
    {
        if ($this->confirm('Do you wish to use permissions?', true)) {
            $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider', '--force' => true]);

            if (! FMS::stringInFile('./app/Models/User.php', 'HasRoles')) {
                FMS::replaceInFile('HasFactory,', 'HasFactory, HasRoles,', app_path('Models/User.php'));

                FMS::replaceInFile(
                    'use Illuminate\Database\Eloquent\Factories\HasFactory;',
                    "use Illuminate\Database\Eloquent\Factories\HasFactory;\ruse Spatie\Permission\Traits\HasRoles;",
                    app_path('Models/User.php')
                );
            }

            $this->call(InstallMiddlewareCommand::class);
        }
    }

    public function handleAdminDashboard(): void
    {
        if ($this->confirm('Do you wish to use the admin dashboard?', true)) {
            (new Filesystem)->ensureDirectoryExists(resource_path('views/admin'));
            (new Filesystem)->copy(
                __DIR__ . '/../../stubs/resources/views/admin/dashboard.blade.php',
                resource_path('views/admin/dashboard.blade.php')
            );
        }
    }

    public function handleUserDashboard(): void
    {
        if ($this->confirm('Do you wish to use the user dashboard?', true)) {
            (new Filesystem)->ensureDirectoryExists(resource_path('views/user'));
            (new Filesystem)->copy(
                __DIR__ . '/../../stubs/resources/views/user/dashboard.blade.php',
                resource_path('views/user/dashboard.blade.php')
            );
        }
    }
}
