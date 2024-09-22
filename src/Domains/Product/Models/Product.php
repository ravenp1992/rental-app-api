<?php

namespace Domains\Product\Models;

use App\Traits\HasUuid;
use Database\Factories\ProductFactory;
use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Domains\User\Models\User;
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
        'status' => ProductStatus::DRAFT->value,
        'published_at' => null,
    ];

    protected $fillable = [
        'uuid',
        'user_id',
        'category_id',
        'name',
        'description',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
