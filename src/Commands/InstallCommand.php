<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;


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

        $this->handleNameFields();
        $this->addAvatarStorageDisk();
        $this->handleUserDashboard();
        $this->handleAdminDashboard();
        $this->handlePermissions();
        $this->updateUserModel();

        $this->comment('Don\'t forget to add the necessary keys to your .env file');
        return Command::SUCCESS;
    }

    protected function handleNameFields()
    {
        $hasSingleField = $this->confirm('Do you wish to use a single name field?', true);

        $this->addAvatarToUserModel($hasSingleField);

        if (!$hasSingleField) {
            if (!$this->stringInFile(app_path('Models/User.php'), "`protected \$fillable = [`")) {
                $this->replaceInFile(
                    'protected $fillable = [',
                    "protected \$fillable = [ \n\t\t'firstname', \n\t\t'lastname',",
                    app_path('Models/User.php')
                );
            }
        }
    }

    public function addAvatarToUserModel(bool $hasSingleField = true)
    {
        if (!$this->stringInFile('./app/Models/User.php', "avatarUrl")) {
            $this->appendBeforeLastCurlyBrace(
                "\n    public function avatarUrl()\n    {\n" .
                    "        return \$this->avatar\n" .
                    "            ? Storage::disk('avatars')->url(\$this->avatar)\n" .
                    "            : 'https://ui-avatars.com/api/?name=' . urlencode(" .
                    ($hasSingleField ? "\$this->name" : "\$this->firstname . ' ' . \$this->lastname") . ") . '&color=7F9CF5&background=EBF4FF';\n" .
                    "    }\n",
                './app/Models/User.php'
            );
        }
    }

    public function addAvatarStorageDisk()
    {
        if (!$this->stringInFile('./config/filesystems.php', "'avatars' => [")) {
            $this->replaceInFile(
                "'disks' => [",
                "'disks' => [\n\n\t\t" .
                    "'avatars' => [\n" .
                    "\t\t\t'driver' => 'local',\n" .
                    "\t\t\t'root' => storage_path('app/public/avatars'),\n" .
                    "\t\t\t'url' => env('APP_URL') . '/storage/avatars',\n" .
                    "\t\t\t'visibility' => 'public',\n" .
                    "\t\t],",
                './config/filesystems.php'
            );
        }
    }

    public function handlePermissions()
    {
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
        }
    }

    public function handleAdminDashboard(): void
    {
        if ($this->confirm('Do you wish to use the admin dashboard?')) {
            File::append(
                base_path('routes/web.php'),
                "\nRoute::middleware(['role:super|admin', 'auth'])->prefix('admin')->name('admin')->group(function () {\n" .
                    "   Route::view('/dashboard', 'admin.dashboard');\n" .
                    "});\n"
            );
            (new Filesystem)->ensureDirectoryExists(resource_path('views/admin'));
            (new Filesystem)->copy(
                __DIR__ . '/../../stubs/resources/views/admin/dashboard.blade.php',
                resource_path('views/admin/dashboard.blade.php')
            );
        }
    }

    public function handleUserDashboard(): void
    {
        if ($this->confirm('Do you wish to use the user dashboard?')) {
            File::append(
                base_path('routes/web.php'),
                "\nRoute::middleware(['auth', 'verified'])->prefix('user')->name('user')->group(function () {\n" .
                    "   Route::view('/dashboard', 'user.dashboard')->name('.dashboard');\n" .
                    "});\n"
            );

            (new Filesystem)->ensureDirectoryExists(resource_path('views/user'));

            (new Filesystem)->copy(
                __DIR__ . '/../../stubs/resources/views/user/dashboard.blade.php',
                resource_path('views/user/dashboard.blade.php')
            );
        }
    }

    public function updateUserModel()
    {
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

        if (!$this->stringInFile(app_path('Models/User.php'), 'use Illuminate\Support\Facades\Storage;')) {
            $this->replaceInFile(
                'use Illuminate\Contracts\Auth\MustVerifyEmail;',
                "use Illuminate\Contracts\Auth\MustVerifyEmail; \ruse Illuminate\Support\Facades\Storage;",
                app_path('Models/User.php')
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
