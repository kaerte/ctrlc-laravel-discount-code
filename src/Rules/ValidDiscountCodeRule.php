<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Rules;

use Carbon\Carbon;
use Ctrlc\DiscountCode\Models\DiscountCode;
use Illuminate\Contracts\Validation\Rule;

class ValidDiscountCodeRule implements Rule
{
    protected $custom_message = '';

    public function passes($attribute, $value)
    {
        $code = DiscountCode
            ::ofActive()
            ->ofStarted()
            ->where('code', $value)
            ->first();

        if (!$code) {
            $this->custom_message = 'The discount code is invalid';

            return false;
        }

        if ($code->expires_at <= Carbon::now()) {
            $this->custom_message = 'The discount code is expired';

            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->custom_message ? $this->custom_message : 'The discount code is invalid..';
    }
}
