<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Models;

use Carbon\Carbon;
use Ctrlc\DiscountCode\Database\Factories\DiscountCodeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
        'starts_at',
        'deleted_at',
    ];

    protected $casts = [
        'amount' => 'double',
        'amount_type' => 'integer',
        'active' => 'boolean',
    ];

    const TYPE_PERCENTAGE = 0;
    const TYPE_MONEY = 1;

    //CUSTOM ATTRIBUTES
    public function getFormattedAmountAttribute()
    {
        switch ($this->amount_type) {
            case (self::TYPE_MONEY):
                return currency_format((float) $this->amount, 'GBP');

                break;
            case (self::TYPE_PERCENTAGE):
                return number_format($this->amount, 1) . '%';

                break;
        }
    }

    // SCOPES
    public function scopeOfActive($query)
    {
        return $query->where('active', 1);
    }

    // SCOPES
    public function scopeOfInactive($query)
    {
        return $query->where('active', 0);
    }

    public function scopeOfNotExpired($query)
    {
        return  $query->where('expires_at', '>=', Carbon::now());
    }

    public function scopeOfStarted($query)
    {
        return  $query->where('starts_at', '<=', Carbon::now());
    }

    protected static function newFactory(): DiscountCodeFactory
    {
        return DiscountCodeFactory::new();
    }
}
