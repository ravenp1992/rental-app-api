<?php

namespace Domains\Category\DataTransferObjects;

class CategoryData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly ?int $isActive
    ) {
        //
    }

    public static function fromArray(array $validated): self
    {
        return new self(
            name: $validated['name'],
            isActive: $validated['isActive']
        );
    }
}
