<?php

namespace Naykel\Authit;

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

        // Nav...
        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../stubs/resources/navs', resource_path('navs'));

        // Update "Dashboard" Route...
        $this->replaceInFile('/home', '/user/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Implement MustVerifyEmail to User model
        if (!$this->stringInFile(app_path('Models/User.php'), 'class User extends Authenticatable implements MustVerifyEmail')) {
            $this->replaceInFile('class User extends Authenticatable', 'class User extends Authenticatable implements MustVerifyEmail', app_path('Models/User.php'));
        }

        return Command::SUCCESS;
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
