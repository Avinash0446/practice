<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Str::macro('maskphone', function ($number) {
            return substr($number, 0, 2) . '******' . substr($number, -2);
        });

        Str::macro('maskemail', function ($email) {
            $parts = explode('@', $email);
            $name = $parts[0];
            $domain = $parts[1];
            return substr($name, 0, 2) . '****@' . $domain;
        });
    }
}
