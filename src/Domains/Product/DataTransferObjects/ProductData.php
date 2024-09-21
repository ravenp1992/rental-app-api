<?php

namespace Domains\Product\DataTransferObjects;

use App\Http\Requests\UpsertProductRequest;
use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;

class ProductData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly Category $category,
        public readonly string $name,
        public readonly ?string $description,
        public readonly int $rentPrice,
        public readonly ?int $buyPrice,
        public readonly int $deposit,
        public readonly int $stockQuantity,
        public readonly string $status,
        public readonly ?string $published_at,
    ) {
        //
    }

    public static function fromRequest(UpsertProductRequest $request): self
    {
        return new static(
            category: $request->getCategory(),
            name: $request->name,
            description: $request->description,
            rentPrice: $request->rentPrice,
            buyPrice: $request->buyPrice,
            deposit: $request->deposit ?? 0,
            stockQuantity: $request->stockQuantity ?? 1,
            status: $request->status ?? ProductStatus::DRAFT->value,
            published_at: $request->published_at,
        );
    }
}
