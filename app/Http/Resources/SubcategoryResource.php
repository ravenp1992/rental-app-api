<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class SubcategoryResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'categoryId' => $this->category_id,
            'name' => $this->name,
            'status' => $this->status,
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'category' => fn () => CategoryResource::make($this->category),
        ];
    }
}
