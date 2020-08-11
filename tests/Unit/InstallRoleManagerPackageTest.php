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

        $this->deleteIfExists($project_config_path = config_path('permissions.php'));

        $this->assertFalse(File::exists($project_config_path));

        Artisan::call('permission:setup');

        $this->assertTrue(File::exists($project_config_path));
    }

    /**
     * @test
     */
    public function the_install_command_copies_package_service_provider()
    {
        $this->deleteIfExists($project_service_provider = app_path('/Providers/RoleManagerServiceProvider.php'));

        $this->assertFalse(File::exists($project_service_provider));

        Artisan::call('permission:setup');

        $this->assertTrue(File::exists($project_service_provider));
    }

    /**
     * delete file if exists
     *
     * @param  mixed $file
     * @return void
     */
    private function deleteIfExists($file)
    {

        if (File::exists($file)) {

            File::delete($file);
        }
    }
}
