<?php

namespace Naykel\Authit;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'authit:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Authit resources';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Nav...
        (new Filesystem)->ensureDirectoryExists(resource_path('navs'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../stubs/resources/navs', resource_path('navs'));

        // "Dashboard" Route...
        $this->replaceInFile('/home', '/user/dashboard', app_path('Providers/RouteServiceProvider.php'));

        // Publish Fortify Assets...
        Artisan::call('vendor:publish', [
            '--provider' => 'Laravel\Fortify\FortifyServiceProvider',
        ]);

        // Remove Fortify Features...
        if (!$this->stringInFile('./config/fortify.php', '// Features::updatePasswords(),')) {
            $this->replaceInFile('Features::updatePasswords(),', '// Features::updatePasswords(),',  './config/fortify.php');
        }

        // Register Service Provider...
        if (!$this->stringInFile('./config/app.php', 'FortifyServiceProvider')) {
            $this->replaceInFile(
                'App\Providers\RouteServiceProvider::class,',
                'App\Providers\RouteServiceProvider::class,' . "\r\t\t" . 'App\Providers\FortifyServiceProvider::class,',
                './config/app.php'
            );
        }

        // Fortify updated service provider with views...
        (new Filesystem)->ensureDirectoryExists(app_path('Providers'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../stubs/Providers', app_path('Providers'));

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
