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

    public static function fromArray(array $validated): self
    {
        return new static(
            product: Product::where('uuid', $validated['productId'])->firstOrFail(),
            dailyRate: $validated['dailyRate'],
            weeklyRate: $validated['weeklyRate'],
            monthlyRate: $validated['monthlyRate'],
            buyPrice: $validated['buyPrice'] ?? null,
            currency: $validated['currency'],
            validFrom: $validated['validFrom'],
            validTo: $validated['validTo'],
        );
    }
}
