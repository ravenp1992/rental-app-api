<?php

namespace Domains\PricePlan\Models;

use App\Traits\HasUuid;
use Database\Factories\PricePlanFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    use HasFactory;
    use HasUuid;

    protected $fillable = [
        'uuid',
        'name',
        'description',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    protected static function newFactory(): Factory
    {
        return PricePlanFactory::new();
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
