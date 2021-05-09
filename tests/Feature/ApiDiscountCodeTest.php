<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Tests\Feature;

use Ctrlc\DiscountCode\Models\DiscountCode;
use Ctrlc\DiscountCode\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiDiscountCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_valid_discount_code(): void
    {
        $discountCodes = DiscountCode::factory()
            ->count(10)
            ->active()
            ->create();

        $response = $this->postJson(route('api.discount-code.check'), [
            'code' => $discountCodes->first()->code,
        ]);

        $response->assertJsonStructure([
            'code',
            'type',
            'value',
        ]);
    }

    public function test_api_disabled_discount_code(): void
    {
        $discountCode = DiscountCode::factory()
            ->disabled()
            ->create();

        $response = $this->postJson(route('api.discount-code.check'), [
            'code' => $discountCode->code,
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment([__('ctrlc_discount_code::messages.code_not_found')]);
        $response->assertJsonStructure([
            'errors' => [
                0 => 'code',
            ],
        ]);
    }

    public function test_api_expired_discount_code(): void
    {
        $discountCode = DiscountCode::factory()
            ->enabled()
            ->expired()
            ->create();

        $response = $this->postJson(route('api.discount-code.check'), [
            'code' => $discountCode->code,
        ]);

        $response->assertStatus(422);
        $response->assertJsonFragment([__('ctrlc_discount_code::messages.code_expired')]);
        $response->assertJsonStructure([
            'errors' => [
                0 => 'code',
            ],
        ]);
    }
}
