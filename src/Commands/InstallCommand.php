<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    protected $signature = 'authit:install';
    protected $description = 'Install Authit resources';

    public function handle(): int
    {
        $this->handlePermissions();
        $this->handleAdminDashboard();
        $this->handleUserDashboard();
        $this->handleSeeders();
        $this->updateUserModel();

        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/navs', resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/resources/views/components', resource_path('views/components'));

        $this->info('Authit installed successfully!');
        $this->info('To enable split name fields, publish the config and set split_name_fields to true.');

        return Command::SUCCESS;
    }

    protected function handleSeeders(): void
    {
        if (! $this->confirm('Publish demo seeders for roles, permissions, and users?', true)) {
            return;
        }

        $source = __DIR__ . '/../../stubs/database/seeders';
        $destination = database_path('seeders');

        (new Filesystem)->ensureDirectoryExists($destination);

        collect(['RolesPermissionsSeeder.php', 'UsersSeeder.php'])->each(function (string $file) use ($source, $destination): void {
            $sourcePath = str_replace('/', DIRECTORY_SEPARATOR, $source . '/' . $file);

            $content = file_get_contents($sourcePath);

            if ($content === false) {
                return;
            }

            $content = str_replace('namespace Naykel\\Authit\\Database\\Seeders;', 'namespace Database\\Seeders;', $content);

            file_put_contents($destination . '/' . $file, $content);
        });

        $this->addSeedersToDatabaseSeeder();
    }

    protected function addSeedersToDatabaseSeeder(): void
    {
        $path = database_path('seeders/DatabaseSeeder.php');

        if (! file_exists($path)) {
            return;
        }

        $content = file_get_contents($path);

        if (strpos($content, 'RolesPermissionsSeeder') !== false) {
            return;
        }

        $callBlock = "\$this->call([\n";
        $callBlock .= "    RolesPermissionsSeeder::class,\n";
        $callBlock .= "    UsersSeeder::class,\n";
        $callBlock .= ']);';

        $content = preg_replace('/public function run\(\): void\s+\{/', "public function run(): void\n    {\n        " . $callBlock, $content);

        file_put_contents($path, $content);
    }

    public function handlePermissions(): void
    {
        if ($this->confirm('Do you wish to use permissions?', true)) {
            $this->callSilent('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider', '--force' => true]);

            $this->addHasRolesTraitToUserModel();
            $this->call(InstallMiddlewareCommand::class);
        }
    }

    protected function addHasRolesTraitToUserModel(): void
    {
        $userModelPath = app_path('Models/User.php');

        if (! file_exists($userModelPath)) {
            return;
        }

        $content = file_get_contents($userModelPath);

        if (strpos($content, 'HasRoles') !== false) {
            return;
        }

        $content = str_replace('HasFactory,', 'HasFactory, HasRoles,', $content);

        $useNeedle = 'use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;';
        $useInsert = "use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\nuse Spatie\\Permission\\Traits\\HasRoles;";

        if (strpos($content, $useNeedle) !== false) {
            $content = str_replace($useNeedle, $useInsert, $content);
        }

        file_put_contents($userModelPath, $content);
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

    public function updateUserModel(): void
    {
        $userModelPath = app_path('Models/User.php');

        if (! file_exists($userModelPath)) {
            return;
        }

        $content = file_get_contents($userModelPath);

        if (strpos($content, 'MustVerifyEmail') !== false) {
            return;
        }

        $content = str_replace(
            'class User extends Authenticatable',
            'class User extends Authenticatable implements MustVerifyEmail',
            $content
        );

        $contractNeedle = '// use Illuminate\Contracts\Auth\MustVerifyEmail;';
        $contractReplace = 'use Illuminate\Contracts\Auth\MustVerifyEmail;';

        if (strpos($content, $contractNeedle) !== false) {
            $content = str_replace($contractNeedle, $contractReplace, $content);
        }

        file_put_contents($userModelPath, $content);
    }
}
