<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Providers;

use Illuminate\Support\ServiceProvider;

class DiscountCodeServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(dirname(__DIR__, 2) . '/config/config.php', 'ctrlc.discount-code');
        // Bind eloquent models to IoC container
        //$this->app->singleton('ctrlc.discount-code',GeoCoding::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations/2020_04_05_122340_create_discount_codes_table.php');
    }
}
