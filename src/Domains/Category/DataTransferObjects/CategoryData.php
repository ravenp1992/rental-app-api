<?php

namespace Domains\Category\DataTransferObjects;

class CategoryData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $status
    ) {
        //
    }

    public static function fromArray(array $validated): self
    {
        return new self(
            name: $validated['name'],
            status: $validated['status']
        );
    }
}
