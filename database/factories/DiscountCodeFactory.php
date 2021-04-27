<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Database\Factories;

use Carbon\Carbon;
use Ctrlc\DiscountCode\Enums\DiscountCodeType;
use Ctrlc\DiscountCode\Models\DiscountCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Spatie\Enum\Faker\FakerEnumProvider;
use Faker\Generator as Faker;

class DiscountCodeFactory extends Factory
{
    protected $model = DiscountCode::class;

    public function definition()
    {
        /** @var Faker|FakerEnumProvider $faker */
        $faker = new Faker();
        $faker->addProvider(new FakerEnumProvider($faker));

        return [
            'code' => Str::random(),
            'value' => rand(0, 1000),
            'type' => $faker->randomEnumValue(DiscountCodeType::class),
            'title' => $this->faker->colorName . ' discount code',
            'description' => $this->faker->text,
            'active_from' => Carbon::now(),
            'active_to' => Carbon::now()->addWeek(),
            'enabled' => $this->faker->boolean(),
        ];
    }
}
