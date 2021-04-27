<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Providers;

use Illuminate\Support\ServiceProvider;

class DiscountCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations/2020_04_05_122340_create_discount_codes_table.php');
    }
}
