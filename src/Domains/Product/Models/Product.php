<?php

namespace Domains\Product\Models;

use App\Traits\HasUuid;
use Database\Factories\ProductFactory;
use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use HasUuid;

    protected $attributes = [
        'deposit' => 0,
        'stock_quantity' => 1,
        'status' => ProductStatus::DRAFT,
    ];

    protected $fillable = [
        'uuid',
        'category_id',
        'name',
        'description',
        'rent_price',
        'buy_price',
        'deposit',
        'stock_quantity',
        'status',
        'published_at',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function publish(): void
    {
        $this->status = ProductStatus::PUBLISHED->value;
        $this->publish_at = now();

        $this->save();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
