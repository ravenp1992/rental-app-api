<?php

namespace Domains\Product\DataTransferObjects;

use App\Http\Requests\PricePlan\UpsertPricePlanRequest;

class PricePlanData
{
    public function __construct(
        public readonly string $name,
        public readonly string $description
    ) {}

    public static function fromRequest(UpsertPricePlanRequest $request): self
    {
        return new self(
            name: $request->name,
            description: $request->description
        );
    }
}
