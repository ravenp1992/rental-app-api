<?php

namespace App\Models;

use App\Enums\ProductStatus;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'name',
        'description',
        'rent_price',
        'buy_price',
        'deposit',
        'stock_quantity',
        'status',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
