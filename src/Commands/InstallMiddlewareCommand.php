<?php

namespace Naykel\Authit\Commands;

use Illuminate\Console\Command;

class InstallMiddlewareCommand extends Command
{
    protected $signature = 'authit:install-middleware';
    protected $description = 'Install Authit middleware aliases';

    public function handle(): int
    {
        $this->addMiddlewareAliases();

        return Command::SUCCESS;
    }

    protected function addMiddlewareAliases(): void
    {
        $appPath = base_path('bootstrap/app.php');

        if (! file_exists($appPath)) {
            return;
        }

        $content = file_get_contents($appPath);

        if (strpos($content, "'role' => \\Spatie\\Permission\\Middleware\\RoleMiddleware::class") !== false) {
            return;
        }

        $aliasBlock = "\n        \$middleware->alias([\n";
        $aliasBlock .= "            'role' => \\Spatie\\Permission\\Middleware\\RoleMiddleware::class,\n";
        $aliasBlock .= "            'permission' => \\Spatie\\Permission\\Middleware\\PermissionMiddleware::class,\n";
        $aliasBlock .= "            'role_or_permission' => \\Spatie\\Permission\\Middleware\\RoleOrPermissionMiddleware::class,\n";
        $aliasBlock .= "        ]);";

        $needle = '->withMiddleware(function (Middleware $middleware) {';

        if (strpos($content, $needle) === false) {
            return;
        }

        $content = str_replace($needle, $needle . $aliasBlock, $content);

        file_put_contents($appPath, $content);
    }
}
