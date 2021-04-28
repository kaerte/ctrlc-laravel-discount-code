<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Rules;

use Ctrlc\DiscountCode\Models\DiscountCode;
use Illuminate\Contracts\Validation\Rule;

class DiscountCodeRule implements Rule
{
    protected string|array $message;

    public function passes($attribute, $value): bool
    {
        $code = DiscountCode::query()
            ->where('code', $value)
            ->first();

        if (!$code || !$code->enabled) {
            $this->message = __('ctrlc_discount_code::messages.code_not_found');

            return false;
        }

        if ($code->isExpired()) {
            $this->message = __('ctrlc_discount_code::messages.code_expired');

            return false;
        }

        return true;
    }

    public function message(): array|string
    {
        return $this->message;
    }
}
