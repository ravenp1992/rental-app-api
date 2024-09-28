<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class ProductPriceResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'dailyRate' => $this->daily_rate,
            'weeklyRate' => $this->weekly_rate,
            'monthlyRate' => $this->monthly_rate,
            'buyPrice' => $this->buy_price,
            'currency' => $this->currency,
            'validFrom' => $this->valid_from,
            'validTo' => $this->valid_to,
        ];
    }
}
