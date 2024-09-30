<?php

namespace Domains\Category\DataTransferObjects;

use Domains\Category\Models\Category;

class SubcategoryData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly Category $category,
        public readonly string $name,
        public readonly int $isActive
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            category: $data['category'],
            name: $data['name'],
            isActive: $data['isActive'] ?? 0
        );
    }
}
