<?php declare(strict_types=1);


use Ctrlc\DiscountCode\Http\Controllers\API\DiscountCodeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::group(['middleware' => ['api']], function () {
        Route::post('/discount-code/check', DiscountCodeController::class)->name('api.discount-code.check');
    });
});
