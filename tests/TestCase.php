<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests;

use Ctrlc\DiscountCode\Providers\DiscountCodeServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__ . '../database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '../migrations');
    }

    protected function getPackageProviders($app)
    {
        return [DiscountCodeServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/migrations/2014_10_12_000000_create_users_table.php';
        (new \CreateUsersTable())->up();
    }
}
