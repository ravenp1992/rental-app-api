<?php

namespace Domains\Product\Models;

use App\Traits\HasUuid;
use Database\Factories\PriceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;
    use HasUuid;

    protected $attributes = [
        'currency' => 'USD',
    ];

    protected $fillable = [
        'uuid',
        'product_id',
        'daily_rate',
        'weekly_rate',
        'monthly_rate',
        'buy_price',
        'currency',
        'valid_from',
        'valid_to',
    ];

    protected static function newFactory(): Factory
    {
        return PriceFactory::new();
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
