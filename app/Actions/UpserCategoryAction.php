<?php

namespace App\Actions;

use App\Data\CategoryData;
use App\Models\Category;

class UpserCategoryAction
{
    public function execute(Category $category, CategoryData $categoryData): Category
    {
        $category->name = $categoryData->name;
        $category->is_active = $categoryData->isActive;
        $category->save();

        return $category;
    }
}
