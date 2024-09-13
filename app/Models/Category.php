<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $cast = [
        'is_active' => 'int',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
