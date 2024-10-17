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

    public static function fromArray(array $data): self
    {
        return new static(
            owner: User::where('uuid', $data['userId'])->firstOrFail(),
            category: Category::where('uuid', $data['categoryId'])->firstOrFail(),
            name: $data['name'],
            description: $data['description'],
            deposit: $data['deposit'] ?? 0,
            stockQuantity: $data['stockQuantity'] ?? 1,
            status: $data['status'] ?? ProductStatus::DRAFT->value,
            publishedAt: $data['publishedAt'] ?? null,
        );
    }
}
