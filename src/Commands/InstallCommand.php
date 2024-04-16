<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'authit:install';

    /**
     * The console command description.
     */
    protected $description = 'Install Authit resources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Copy layouts, views and navs...
        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));

        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/navs', resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/components', resource_path('views/components'));

        // $this->handleDashboardAndAccount();
        $this->handlePermissions();
        $this->updateUserModel();
        $this->addAvatarStorageDisk();

        $this->comment('Don\'t forget to add the necessary keys to your .env file');
        return Command::SUCCESS;
    }

    public function handlePermissions()
    {
        // php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
        if ($this->confirm('Do you wish to use permissions?', true)) {
            $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider', '--force' => true]);

            // add HasRoles trait in user model
            if (!$this->stringInFile('./app/Models/User.php', "HasRoles")) {
                $this->replaceInFile('HasFactory,', 'HasFactory, HasRoles,', 'app/Models/User.php');

                $this->replaceInFile(
                    'use Illuminate\Database\Eloquent\Factories\HasFactory;',
                    "use Illuminate\Database\Eloquent\Factories\HasFactory;\ruse Spatie\Permission\Traits\HasRoles;",
                    'app/Models/User.php'
                );
            }

            // Add package middleware
            // NK::TD permissions are 644. need is a 
            // if (!$this->stringInFile('./bootstrap/app.php', "Spatie\Permission\Middlewares")) {
            //     $this->replaceInFile(
            //         "->withMiddleware(function (Middleware \$middleware) {",
            //             "\$middleware->alias([",
            //                 "'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,",
            //                 "'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,",
            //                 "'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,",
            //             "]);",
            //     );
            // }
        }
    }

    // public function handleDashboardAndAccount(): void
    // {
    //     if ($this->confirm('Do you wish to install the dashboard?')) {
    //         // Publish the dashboard and set `HOME` route to `user.dashboard`
    //         $this->replaceInFile('/home', '/user/dashboard', app_path('Providers/RouteServiceProvider.php'));
    //         (new Filesystem)->ensureDirectoryExists(resource_path('views/user'));
    //         (new Filesystem)->copy(__DIR__ . '/../../stubs/resources/views/user/dashboard.blade.php', resource_path('views/user/dashboard.blade.php'));
    //     } else {
    //         // Publish the dashboard and set `HOME` route to `user.account`
    //         $this->replaceInFile('/home', '/user/account', app_path('Providers/RouteServiceProvider.php'));
    //     }
    // }

    public function updateUserModel()
    {
        // Add avatarUrl method to User model
        if (!$this->stringInFile('./app/Models/User.php', "avatarUrl")) {
            $this->appendBeforeLastCurlyBrace(
                "\r    public function avatarUrl() {
        return \$this->avatar
            ? Storage::disk('avatars')->url(\$this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode(\$this->name) . '&color=7F9CF5&background=EBF4FF';
    }",
                './app/Models/User.php'
            );
        }

        // Implement MustVerifyEmail to User model
        if (!$this->stringInFile(app_path('Models/User.php'), 'class User extends Authenticatable implements MustVerifyEmail')) {

            $this->replaceInFile(
                'class User extends Authenticatable',
                'class User extends Authenticatable implements MustVerifyEmail',
                app_path('Models/User.php')
            );
            $this->replaceInFile(
                '// use Illuminate\Contracts\Auth\MustVerifyEmail;',
                'use Illuminate\Contracts\Auth\MustVerifyEmail;',
                app_path('Models/User.php')
            );
        }

        if (!$this->confirm('Do you wish to use a single name field?', true)) {
            // update fillable
            if (!$this->stringInFile(app_path('Models/User.php'), "`protected \$fillable = [`")) {
                $this->replaceInFile(
                    'protected $fillable = [',
                    "protected \$fillable = [ \n\t\t'firstname', \n\t\t'lastname',",
                    app_path('Models/User.php')
                );
            }
        }

        // Implement
        if (!$this->stringInFile(app_path('Models/User.php'), 'use Illuminate\Support\Facades\Storage;')) {
            $this->replaceInFile(
                'use Illuminate\Contracts\Auth\MustVerifyEmail;',
                "use Illuminate\Contracts\Auth\MustVerifyEmail; \ruse Illuminate\Support\Facades\Storage;",
                app_path('Models/User.php')
            );
        }
    }

    public function addAvatarStorageDisk()
    {
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

    /**
     * Append a given string before the last curly brace in a given file.
     *
     * It finds the last curly brace (which should be the closing brace of the
     * class) and inserts the provided string before it. This is useful for
     * programmatically adding methods to a class.
     *
     * @param string $insertion The string to be inserted before the last curly brace
     * @param string $path The path to the PHP file where the insertion should be made.
     */
    protected function appendBeforeLastCurlyBrace($insertion, $path): void
    {
        // Read the content of the file into a string.
        $content = file_get_contents($path);

        // Find the position of the last curly brace in the string.
        $lastCurlyBracePos = strrpos($content, '}');

        // This condition checks if the last curly brace was found in the string.
        if ($lastCurlyBracePos !== false) {
            // This line inserts $insertion before the last curly brace in the string,
            // and then writes the modified string back to the file.
            $content = substr_replace($content, $insertion . "\n}", $lastCurlyBracePos, 1);
            file_put_contents($path, $content);
        }
    }
}
