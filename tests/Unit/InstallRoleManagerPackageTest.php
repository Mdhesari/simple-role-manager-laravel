<?php

namespace Mdhesari\RoleManager\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mdhesari\RoleManager\Tests\TestCase;

class InstallRoleManagerPackageTest extends TestCase
{

    /** @test */
    public function the_install_command_copies_the_config_file()
    {

        if (File::exists($project_config_path = config_path('permissions.php'))) {

            File::delete($project_config_path);
        }

        $this->assertFalse(File::exists($project_config_path));

        Artisan::call('permission:setup');

        $this->assertTrue(File::exists($project_config_path));
    }
}
