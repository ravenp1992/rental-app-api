<?php

namespace Domains\Product\DataTransferObjects;

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

    public static function fromArray(array $validated): self
    {
        return new static(
            owner: User::where('uuid', $validated['userId'])->firstOrFail(),
            category: Category::where('uuid', $validated['categoryId'])->firstOrFail(),
            name: $validated['name'],
            description: $validated['description'],
            deposit: $validated['deposit'] ?? 0,
            stockQuantity: $validated['stockQuantity'] ?? 1,
            status: $validated['status'] ?? ProductStatus::DRAFT->value,
            publishedAt: $validated['publishedAt'] ?? null,
        );
    }
}
