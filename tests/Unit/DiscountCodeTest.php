<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests\Unit;

use Ctrlc\DiscountCode\Models\DiscountCode;
use Ctrlc\DiscountCode\Tests\TestCase;

class DiscountCodeTest extends TestCase
{
    public function test_factory(): void
    {
        $discountCode = DiscountCode::factory()->make();
        self::assertInstanceOf(DiscountCode::class, $discountCode);
    }

    public function test_active(): void
    {
        $discountCode = DiscountCode::factory()
            ->active()
            ->make();

        self::assertTrue($discountCode->isActive());
    }

    public function test_active_disabled(): void
    {
        $discountCode = DiscountCode::factory()
            ->active()
            ->disabled()
            ->make();

        self::assertNotTrue($discountCode->isActive());
    }

    public function test_enabled(): void
    {
        $discountCode = DiscountCode::factory()
            ->enabled()
            ->make();

        self::assertTrue($discountCode->isActive());
    }

    public function test_disabled(): void
    {
        $discountCode = DiscountCode::factory()
            ->disabled()
            ->make();

        self::assertNotTrue($discountCode->isActive());
    }

    public function test_expired(): void
    {
        $discountCode = DiscountCode::factory()
            ->expired()
            ->make();

        self::assertNotTrue($discountCode->isActive());
    }
}
