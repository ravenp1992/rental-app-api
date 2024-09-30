<?php

namespace Domains\Product\Actions;

use Domains\Product\DataTransferObjects\PriceData;
use Domains\Product\Models\Price;

class UpsertPriceAction
{
    public static function execute(Price $price, PriceData $priceData): Price
    {
        $price->product_id = $priceData->product->id;
        $price->daily_rate = $priceData->dailyRate;
        $price->weekly_rate = $priceData->weeklyRate;
        $price->monthly_rate = $priceData->monthlyRate;
        $price->buy_price = $priceData->buyPrice;
        $price->currency = $priceData->currency;
        $price->valid_from = $priceData->validFrom;
        $price->valid_to = $priceData->validTo;
        $price->save();

        return $price;
    }
}
