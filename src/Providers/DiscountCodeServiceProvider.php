<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Providers;

use Illuminate\Support\ServiceProvider;

class DiscountCodeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/2020_01_01_000000_create_discount_codes_table.php');
        $this->loadTranslationsFrom(dirname(__DIR__, 2).'/resources/lang', 'ctrlc_discount_code');
    }
}
