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

        // config
        $this->publishes([
            $dir . '/../config/permissions.php' => config_path('permissions.php'),
        ], 'config-role');

        /**
         * Database
         */
        $migration_path = database_path('migrations/');
        $seeds_path = database_path('seeds/');

        // migrations
        $this->publishes([
            $dir . '/../database/migrations/create_roles_table.php.stub' => $migration_path . date('Y_m_d_His', time()) . '_create_roles_table.php',
            $dir . '/../database/migrations/create_role_user_table.php.stub' => $migration_path . date('Y_m_d_His', time()) . '_create_role_user_table.php',
        ], 'migrations-role');

        // seeds
        $this->publishes([
            $dir . '/../database/seeds/RoleTableSeeder.php.stub' => $seeds_path . 'RoleTableSeeder.php',
        ], 'seeder-role');
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
