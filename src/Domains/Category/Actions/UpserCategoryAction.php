<?php

namespace Domains\Category\Actions;

use Domains\Category\DataTransferObjects\CategoryData;
use Domains\Category\Models\Category;

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
