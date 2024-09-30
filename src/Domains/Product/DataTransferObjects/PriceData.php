<?php

namespace Domains\Product\DataTransferObjects;

use Domains\Product\Models\Product;

class PriceData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly Product $product,
        public readonly int $dailyRate,
        public readonly int $weeklyRate,
        public readonly int $monthlyRate,
        public readonly ?int $buyPrice,
        public readonly string $currency,
        public readonly string $validFrom,
        public readonly string $validTo,
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new static(
            product: $data['product'],
            dailyRate: $data['dailyRate'],
            weeklyRate: $data['weeklyRate'],
            monthlyRate: $data['monthlyRate'],
            buyPrice: $data['buyPrice'] ?? null,
            currency: $data['currency'],
            validFrom: $data['validFrom'],
            validTo: $data['validTo'],
        );
    }
}
