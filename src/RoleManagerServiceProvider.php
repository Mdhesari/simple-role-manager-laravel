<?php

namespace Mdhesari\RoleManager;

use Illuminate\Support\ServiceProvider;
use Mdhesari\RoleManager\Console\PermissionCommand;

class RoleManagerServiceProvider extends ServiceProvider
{

    public function register()
    {
        // register and bind classes
    }

    public function boot()
    {
        // publish required files to the project environment using vendor:publish
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        $this->migrateFrom(__DIR__ . '/database/migrations');

        if ($this->app->runningInConsole()) {

            $this->consoleSetup();
        }
    }

    public function consoleSetup()
    {

        /**
         * setup commands
         */
        $this->commands([
            PermissionCommand::class
        ]);
    }
}
