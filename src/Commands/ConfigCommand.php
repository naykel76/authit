<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;

class ConfigCommand extends Command
{
    protected $signature = 'authit:config';
    protected $description = 'Publish Authit config file';

    public function handle()
    {
        $this->call('vendor:publish', ['--tag' => 'authit-config', '--force' => true]);
    }
}
