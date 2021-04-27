<?php declare(strict_types=1);

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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code')->unique();
            $table->unsignedBigInteger('value');
            $table->unsignedTinyInteger('type');
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamp('active_from')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('active_to')->nullable();
            $table->boolean('enabled')->default(0);
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
        Schema::dropIfExists('discount_codes');
    }
}
