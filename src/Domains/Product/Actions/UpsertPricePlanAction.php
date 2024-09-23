<?php

namespace Domains\Product\Actions;

use Domains\Product\DataTransferObjects\PricePlanData;
use Domains\Product\Models\PricePlan;

class UpsertPricePlanAction
{
    public function execute(PricePlan $pricePlan, PricePlanData $pricePlanData): PricePlan
    {
        $pricePlan->name = $pricePlanData->name;
        $pricePlan->description = $pricePlanData->description;

        $pricePlan->save();

        return $pricePlan;
    }
}
