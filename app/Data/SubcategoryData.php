<?php

namespace App\Data;

use App\Http\Requests\UpsertSubcategoryRequest;
use App\Models\Category;

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

    public static function fromRequest(UpsertSubcategoryRequest $request): self
    {
        return new self(
            category: $request->getCategory(),
            name: $request->name,
            isActive: $request->isActive ?? 0
        );
    }
}
