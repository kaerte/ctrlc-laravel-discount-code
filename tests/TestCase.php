<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests;

use Ctrlc\DiscountCode\Providers\DiscountCodeServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__.'../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [DiscountCodeServiceProvider::class];
    }
}
