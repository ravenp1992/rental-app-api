<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class CategoryResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'isActive' => $this->is_active,
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'subCategories' => fn () => SubcategoryResource::collection($this->subCategories),
        ];
    }
}
