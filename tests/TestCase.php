<?php

namespace Mdhesari\RoleManager\Tests;

use Mdhesari\RoleManager\RoleManagerServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function getPackageProviders($app)
    {

        return [
            RoleManagerServiceProvider::class
        ];
    }

    public function getEnvironmentSetUp($app)
    {

        // environment setup
    }
}
