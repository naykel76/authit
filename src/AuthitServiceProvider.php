<?php

namespace Naykel\Authit;

use Illuminate\Support\ServiceProvider;

class AuthitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../views' => resource_path('views'),
            ],
            'nkr'
        );
    }
}
