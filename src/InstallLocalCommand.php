<?php

namespace Naykel\Authit;

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

        // check if local directories exist and create if necessary;
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Livewire/User'));

        // copy livewire component and views
        (new Filesystem)->copy(__DIR__ . '/Http/Livewire/Profile.php', app_path('Http/Livewire/User/Profile.php'));

        // update local namespace
        $this->replaceInFile('Naykel\Authit', 'App', app_path('Http/Livewire/User/Profile.php'));

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
