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

        $this->publishFiles();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        if ($this->app->runningInConsole()) {

            $this->consoleSetup();
        }
    }

    /**
     * publish required files to the project environment using vendor:publish
     *
     * @return void
     */
    public function publishFiles()
    {

        $dir = __DIR__;

        $this->publishes([
            $dir . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config');

        /**
         * Database
         */
        $migration_path = database_path('migrations');

        $this->publishes([
            $dir . '/../database/migrations/create_roles_table.php.stub' => $migration_path . date('Y_m_d_His', time()) . '_create_roles_table.php',
        ], 'migrations');
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
