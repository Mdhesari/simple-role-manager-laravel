<?php

namespace Mdhesari\RoleManager;

use Illuminate\Support\ServiceProvider;

class RoleManagerServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        $this->loadMigrationsFrom('');

    }
}
