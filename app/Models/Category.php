<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
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
        'is_active',
    ];

    protected $attributes = [
        'is_active' => false,
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }
}
