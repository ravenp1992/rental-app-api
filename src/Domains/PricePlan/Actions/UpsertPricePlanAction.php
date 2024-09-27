<?php

namespace Domains\PricePlan\Actions;

use Domains\PricePlan\DataTransferObjects\PricePlanData;
use Domains\PricePlan\Models\PricePlan;

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
