<?php

namespace Mdhesari\RoleManager\Console;

use Illuminate\Console\Command;

class PermissionCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:setup';

    /**
     * The console command help text.
     *
     * @var string|null
     */
    protected $description = 'setup role manager package.';

    /**
     * handle
     *
     * @return void
     */
    public function handle()
    {

        $this->info("Installing role manager package...\nPublishing vendor...");

        $this->call('vendor:publish', [
            '--provider' => 'Mdhesari\RoleManager\RoleManagerServiceProvider',
            '--tag' => 'config'
        ]);
    }
}
