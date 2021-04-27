<?php

namespace Ctrlc\DiscountCode\Seeds;

use Illuminate\Database\Seeder;
use Ctrlc\DiscountCode\Models\DiscountCode;
use Carbon\Carbon;
use DB;

class DiscountCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('ctrlc.discount-code.table_name'))->insertGetId([
            'code' => 'ACTIVE_10_PERCENT_OFF',
            'starts_at' => Carbon::now()->subDay(),
            'expires_at' => Carbon::now()->addYear(),
            'active'=> 1,
            'amount' => 10,
            'amount_type' => DiscountCode::TYPE_PERCENTAGE,
            'title' => '10% off'
        ]);

        DB::table(config('ctrlc.discount-code.table_name'))->insertGetId([
            'code' => 'ACTIVE_20_MONEY_OFF',
            'starts_at' => Carbon::now()->subDay(),
            'expires_at' => Carbon::now()->addYear(),
            'active'=> 1,
            'amount' => 20,
            'amount_type' => DiscountCode::TYPE_MONEY,
            'title' => '20 GBP off'
        ]);

        DB::table(config('ctrlc.discount-code.table_name'))->insertGetId([
            'code' => 'EXPIRED',
            'starts_at' => Carbon::now()->subYears(2),
            'expires_at' => Carbon::now()->subYear(),
            'active'=> 1,
            'amount' => 20,
            'amount_type' => DiscountCode::TYPE_MONEY,
            'title' => '20 GBP off'
        ]);
    }
}
