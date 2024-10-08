<?php

namespace Domains\Category\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Database\Factories\CategoryFactory;
use Domains\Category\Enums\CategoryStatus;
use Domains\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'status',
    ];

    protected $attributes = [
        'status' => CategoryStatus::INACTIVE->value,
    ];

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
