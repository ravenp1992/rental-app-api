<?php

namespace App\Models;

use App\Traits\HasUuid;
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

    protected $cast = [
        'category_id' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
