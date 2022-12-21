<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class InstallLocalCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'authit:install-local';

    /**
     * The console command description.
     */
    protected $description = 'Publish Authit resources locally';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // make sure directories exist...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Livewire/User'));
        (new Filesystem)->ensureDirectoryExists(resource_path('views/user'));

        // copy components and views...
        (new Filesystem)->copy(__DIR__ . '/Http/Livewire/User/Profile.php', app_path('Http/Livewire/User/Profile.php'));
        (new Filesystem)->copy(__DIR__ . '/../resources/views/user/profile.blade.php', resource_path('views/user/profile.blade.php'));

        // copy migrations
        (new Filesystem)->copyDirectory(__DIR__ . '/../stubs/database', base_path('database'));

        // update namespace and templates...
        $this->replaceInFile('authit::user.profile', 'user.profile', app_path('Http/Livewire/User/Profile.php'));
        $this->replaceInFile('Naykel\Authit', 'App', app_path('Http/Livewire/User/Profile.php'));

        // add component class routes
        if (!$this->stringInFile('./routes/web.php', "use App\Http\Livewire\User\Profile;")) {
            $find = "use Illuminate\Support\Facades\Route;";
            $this->replaceInFile($find, "$find\r\r" . 'use App\Http\Livewire\User\Profile;', './routes/web.php');
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
