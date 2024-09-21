<?php

namespace Domains\Category\DataTransferObjects;

use App\Http\Requests\UpsertCategoryRequest;

class CategoryData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly ?string $slug,
        public readonly ?int $isActive
    ) {
        //
    }

    public static function fromRequest(UpsertCategoryRequest $request): self
    {
        return new self(
            $request->name,
            $request->slug,
            $request->isActive
        );
    }
}
