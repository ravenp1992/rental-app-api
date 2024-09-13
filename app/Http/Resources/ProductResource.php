<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class ProductResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'rentPrice' => $this->rent_price,
            'buyPrice' => $this->buy_price,
            'deposit' => $this->deposit,
            'stockQuantity' => $this->stock_quantity,
            'status' => $this->status,
        ];
    }
}
