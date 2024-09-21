<?php

namespace Domains\Subcategory\Models;

use App\Traits\HasUuid;
use Database\Factories\SubcategoryFactory;
use Domains\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subcategory extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'category_id',
        'name',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => 0,
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function newFactory(): Factory
    {
        return SubcategoryFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
