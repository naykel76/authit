<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Naykel\Gotime\Facades\FileManagement as FMS;

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
        $this->handleNameFields();
        $this->handleUserDashboard();
        $this->handlePermissions();
        $this->handleAdminDashboard();

        // Copy layouts, views and navs...
        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/navs', resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/components', resource_path('views/components'));

        return Command::SUCCESS;
    }

    protected function handleNameFields()
    {
        $hasSingleField = $this->confirm('Do you wish to use a single name field?', true);

        if (! $hasSingleField) {
            if (! FMS::stringInFile(app_path('Models/User.php'), '`protected $fillable = [`')) {
                FMS::replaceInFile(
                    'protected $fillable = [',
                    "protected \$fillable = [ \n\t\t'first_name', \n\t\t'last_name',",
                    app_path('Models/User.php')
                );
            }

            if (! FMS::stringInFile('.env', 'AUTHIT_SPLIT_NAME_FIELDS')) {
                File::prepend('.env', "AUTHIT_SPLIT_NAME_FIELDS=false\n\n");
            }
        }
    }

    public function handlePermissions()
    {

        if ($this->confirm('Do you wish to use permissions?', true)) {
            $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider', '--force' => true]);

            if (! FMS::stringInFile('./app/Models/User.php', 'HasRoles')) {
                FMS::replaceInFile('HasFactory,', 'HasFactory, HasRoles,', 'app/Models/User.php');

                FMS::replaceInFile(
                    'use Illuminate\Database\Eloquent\Factories\HasFactory;',
                    "use Illuminate\Database\Eloquent\Factories\HasFactory;\ruse Spatie\Permission\Traits\HasRoles;",
                    'app/Models/User.php'
                );
            }

            FMS::replaceInFile(
                '->withMiddleware(function (Middleware $middleware) {',
                '->withMiddleware(function (Middleware $middleware) {' .
                    "\n\t\t\$middleware->alias([" .
                    "\n\t\t\t'role' => \Spatie\Permission\Middleware\RoleMiddleware::class," .
                    "\n\t\t\t'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class," .
                    "\n\t\t\t'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class," .
                    "\n\t\t]);",
                './bootstrap/app.php'
            );
        }
    }

    public function handleAdminDashboard(): void
    {
        // Routes are handled by the package. No need to add to web.php
        if ($this->confirm('Do you wish to use the admin dashboard?', true)) {
            // File::append(
            //     base_path('routes/web.php'),
            //     "\nRoute::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {\n" .
            //         "   Route::view('/dashboard', 'admin.dashboard');\n" .
            //         "});\n"
            // );
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
            // File::append(
            //     base_path('routes/web.php'),
            //     "\nRoute::middleware(['auth', 'verified'])->prefix('user')->name('user')->group(function () {\n" .
            //         "   Route::view('/dashboard', 'user.dashboard')->name('.dashboard');\n" .
            //         "});\n"
            // );

            (new Filesystem)->ensureDirectoryExists(resource_path('views/user'));

            (new Filesystem)->copy(
                __DIR__ . '/../../stubs/resources/views/user/dashboard.blade.php',
                resource_path('views/user/dashboard.blade.php')
            );
        }
    }

    public function updateUserModel()
    {
        if (! FMS::stringInFile(app_path('Models/User.php'), 'class User extends Authenticatable implements MustVerifyEmail')) {

            FMS::replaceInFile(
                'class User extends Authenticatable',
                'class User extends Authenticatable implements MustVerifyEmail',
                app_path('Models/User.php')
            );
            FMS::replaceInFile(
                '// use Illuminate\Contracts\Auth\MustVerifyEmail;',
                'use Illuminate\Contracts\Auth\MustVerifyEmail;',
                app_path('Models/User.php')
            );
        }

        if (! FMS::stringInFile(app_path('Models/User.php'), 'use Illuminate\Support\Facades\Storage;')) {
            FMS::replaceInFile(
                'use Illuminate\Contracts\Auth\MustVerifyEmail;',
                "use Illuminate\Contracts\Auth\MustVerifyEmail; \ruse Illuminate\Support\Facades\Storage;",
                app_path('Models/User.php')
            );
        }
    }

    /**
     * Append a given string before the last curly brace in a given file.
     *
     * It finds the last curly brace (which should be the closing brace of the
     * class) and inserts the provided string before it. This is useful for
     * programmatically adding methods to a class.
     *
     * @param  string  $insertion  The string to be inserted before the last curly brace
     * @param  string  $path  The path to the PHP file where the insertion should be made.
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
