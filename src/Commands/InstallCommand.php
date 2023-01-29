<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'authit:install {--L|local : Indicates if components and views support should be published}';

    /**
     * The console command description.
     */
    protected $description = 'Install Authit resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // publish local assets...
        if ($this->option('local')) {
            $this->callSilent('vendor:publish', ['--tag' => 'authit-views', '--force' => true]);
        }

        // Publish spatie permissions and update kernel.php...
        $this->installPermissions();

        // Nav...
        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../resources/navs', resource_path('navs'));

        // Update "Dashboard" Route...
        $this->replaceInFile('/home', '/user/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Implement MustVerifyEmail to User model
        if (!$this->stringInFile(app_path('Models/User.php'), 'class User extends Authenticatable implements MustVerifyEmail')) {

            $this->replaceInFile('class User extends Authenticatable', 'class User extends Authenticatable implements MustVerifyEmail', app_path('Models/User.php'));
            $this->replaceInFile('// use Illuminate\Contracts\Auth\MustVerifyEmail;', 'use Illuminate\Contracts\Auth\MustVerifyEmail;', app_path('Models/User.php'));
        }

        // Create avatar disk
        if (!$this->stringInFile('./config/filesystems.php', "'avatars' => [")) {

            $this->replaceInFile(
                "'disks' => [",
                "'disks' => [" . "\r\r\t\t" .
                    "'avatars' => [
            'driver' => 'local',
            'root' => storage_path('app/public/avatars'),
            'url' => env('APP_URL') . '/storage/avatars',
            'visibility' => 'public',
        ],",
                './config/filesystems.php'
            );
        }

        return Command::SUCCESS;
    }


    public function installPermissions()
    {

        $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider', '--force' => true]);

        // // Include HasRoles trait in user model
        if (!$this->stringInFile('./app/Models/User.php', "HasRoles")) {
            $this->replaceInFile('HasFactory,', 'HasFactory, HasRoles,', 'app/Models/User.php');

            $this->replaceInFile(
                'use Illuminate\Database\Eloquent\Factories\HasFactory;',
                "use Illuminate\Database\Eloquent\Factories\HasFactory;\ruse Spatie\Permission\Traits\HasRoles;",
                'app/Models/User.php'
            );
        }

        // Add middleware to kernel.php
        if (!$this->stringInFile('./app/Http/kernel.php', "Spatie\Permission\Middlewares")) {
            $this->replaceInFile(
                "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,",
                "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,",
                './app/Http/kernel.php'
            );
        }
    }

    /**
     * Replace a given string within a given file.
     *
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
    /**
     * A given string exists within a given file.
     *
     * @param string $path
     * @param string $search
     * @return bool
     */
    protected function stringInFile($path, $search)
    {
        return str_contains(file_get_contents($path), $search);
    }
}
