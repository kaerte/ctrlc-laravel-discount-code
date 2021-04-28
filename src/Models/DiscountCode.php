<?php declare(strict_types=1);

namespace Ctrlc\DiscountCode\Models;

use Ctrlc\DiscountCode\Database\Factories\DiscountCodeFactory;
use Ctrlc\DiscountCode\Enums\DiscountCodeTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $visible = [
        'code',
        'type',
        'value',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'active_from',
        'active_to',
    ];

    protected $casts = [
        'value' => 'integer',
        'type' => DiscountCodeTypeEnum::class,
        'code' => 'string',
    ];

    public function isActive()
    {
        return
            $this->enabled
            && $this->active_from <= now()
            && now() < $this->active_to;
    }

    public function isExpired()
    {
        return now() > $this->active_to;
    }

    public function scopeOfEnabled($query)
    {
        return $query->where('enabled', true);
    }

    public function scopeOfDisabled($query)
    {
        return $query->where('disabled', false);
    }

    public function scopeOfExpired($query)
    {
        return $query->where('active_to', '<=', now());
    }

    public function scopeOfActive($query)
    {
        return $query
            ->ofEnabled()
            ->where('active_from', '<=', now())
            ->where('active_to', '>', now());
    }

    protected static function newFactory(): DiscountCodeFactory
    {
        return DiscountCodeFactory::new();
    }
}
