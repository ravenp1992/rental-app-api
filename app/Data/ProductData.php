<?php

namespace App\Data;

use App\Enums\ProductStatus;
use App\Http\Requests\UpsertProductRequest;

class ProductData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly int $rentPrice,
        public readonly ?int $buyPrice,
        public readonly int $deposit,
        public readonly int $stockQuantity,
        public readonly string $status,
    ) {
        //
    }

    public static function fromRequest(UpsertProductRequest $request): self
    {
        return new static(
            $request->name,
            $request->description,
            $request->rentPrice,
            $request->buyPrice,
            $request->deposit ?? 0,
            $request->stockQuantity ?? 1,
            $request->status ?? ProductStatus::DRAFT->value,
        );
    }
}
