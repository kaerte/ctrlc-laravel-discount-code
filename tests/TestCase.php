<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests;

use Ctrlc\DiscountCode\Http\Controllers\API\DiscountCodeController;
use Ctrlc\DiscountCode\Providers\DiscountCodeServiceProvider;
use Illuminate\Routing\Router;

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

    protected function defineRoutes($router): void
    {
        /** @var $router Router */
        $router->post('/discount-code/check', DiscountCodeController::class)->name('api.discount-code.check');
    }
}
