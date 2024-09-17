<?php

namespace App\Actions;

use App\Data\SubcategoryData;
use App\Models\Subcategory;

class UpsertSubcategoryAction
{
    public function execute(Subcategory $subcategory, SubcategoryData $subcategoryData): Subcategory
    {
        $subcategory->category_id = $subcategoryData->category->id;
        $subcategory->name = $subcategoryData->name;
        $subcategory->is_active = $subcategoryData->isActive;
        $subcategory->save();

        return $subcategory;
    }
}
