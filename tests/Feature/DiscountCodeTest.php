<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests\Feature;

use Ctrlc\DiscountCode\Models\DiscountCode;
use Ctrlc\DiscountCode\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiscountCodeTest extends TestCase
{
    use RefreshDatabase;

    public DiscountCode $discountCode;

    protected function setUp(): void
    {
        parent::setUp();

        $this->discountCode = DiscountCode::factory()
            ->create();
    }

}
