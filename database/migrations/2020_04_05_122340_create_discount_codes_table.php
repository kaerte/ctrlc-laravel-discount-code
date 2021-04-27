<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('ctrlc.discount-code.table_name'), function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code')->unique()->comment('discount code');
            $table->double('amount', 8, 4);
            $table->integer('amount_type')->comment('0 = percentage,  1 = money discount');
            $table->string('title')->nullable()->comment('Will appear when discount code is used');
            $table->string('description')->nullable();
            $table->timestamp('starts_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expires_at')->nullable()->default(null);
            $table->boolean('active')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('ctrlc.discount-code.table_name'));
    }
}
