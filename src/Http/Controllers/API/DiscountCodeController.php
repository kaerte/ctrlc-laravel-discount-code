<?php

declare(strict_types=1);

namespace Ctrlc\DiscountCode\Http\Controllers\API;

use Ctrlc\DiscountCode\Models\DiscountCode;
use Ctrlc\DiscountCode\Rules\DiscountCodeRule;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiscountCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'code' => ['exists:discount_codes,code', new DiscountCodeRule],
        ]);

        return DiscountCode::where('code', $request->input('code'))->first();
    }
}
