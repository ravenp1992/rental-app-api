<?php

namespace Domains\Subcategory\DataTransferObjects;

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

    public static function fromArray(array $validated): self
    {
        return new self(
            category: Category::where('uuid', $validated['categoryId'])->firstOrFail(),
            name: $validated['name'],
            isActive: $validated['isActive'] ?? 0
        );
    }
}
