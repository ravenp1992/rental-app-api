<?php

namespace Domains\Product\DataTransferObjects;

use App\Http\Requests\UpsertProductRequest;
use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Domains\User\Models\User;

class ProductData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly User $owner,
        public readonly Category $category,
        public readonly string $name,
        public readonly ?string $description,
        public readonly int $deposit,
        public readonly int $stockQuantity,
        public readonly string $status,
        public readonly ?string $publishedAt,
    ) {
        //
    }

    public static function fromRequest(UpsertProductRequest $request): self
    {
        return new static(
            owner: $request->getOwner(),
            category: $request->getCategory(),
            name: $request->name,
            description: $request->description,
            deposit: $request->deposit ?? 0,
            stockQuantity: $request->stockQuantity ?? 1,
            status: $request->status ?? ProductStatus::DRAFT->value,
            publishedAt: $request->publishedAt,
        );
    }
}
