<?php

namespace Mdhesari\RoleManager;

use Illuminate\Support\ServiceProvider;
use Mdhesari\RoleManager\Console\PermissionCommand;

class RoleManagerServiceProvider extends ServiceProvider
{

    public function register()
    {
    }

    public function boot()
    {
        // publish required files to the project environment using vendor:publish
        $this->publishes([
            __DIR__ . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

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
