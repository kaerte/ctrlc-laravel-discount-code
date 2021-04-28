<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Database\Factories;

use Carbon\Carbon;
use Ctrlc\DiscountCode\Enums\DiscountCodeTypeEnum;
use Ctrlc\DiscountCode\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Spatie\Enum\Laravel\Faker\FakerEnumProvider;

class DiscountCodeFactory extends Factory
{
    protected $model = DiscountCode::class;

    public function definition()
    {
        FakerEnumProvider::register();

        return [
            'code' => Str::random(),
            'value' => rand(10, 1000),
            'type' => $this->faker->randomEnumValue(DiscountCodeTypeEnum::class),
            'title' => $this->faker->colorName . ' discount code',
            'description' => $this->faker->text,
            'active_from' => Carbon::now(),
            'active_to' => Carbon::now()->addWeek(),
            'enabled' => $this->faker->boolean(),
        ];
    }

    public function percent()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => DiscountCodeTypeEnum::PERCENT(),
                'value' => rand(1, 100),
            ];
        });
    }

    public function money()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => DiscountCodeTypeEnum::MONEY(),
                'value' => rand(10, 200),
            ];
        });
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'active_from' => Carbon::now()->subSecond(),
                'active_to' => Carbon::now()->addSecond(),
                'enabled' => true,
            ];
        });
    }

    public function expired()
    {
        return $this->state(function (array $attributes) {
            return [
                'active_to' => Carbon::now()->subSecond(),
            ];
        });
    }

    public function enabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'enabled' => true,
            ];
        });
    }

    public function disabled()
    {
        return $this->state(function (array $attributes) {
            return [
                'enabled' => false,
            ];
        });
    }
}
