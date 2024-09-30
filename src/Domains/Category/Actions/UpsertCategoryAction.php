<?php

namespace Domains\Category\Actions;

use Domains\Category\DataTransferObjects\CategoryData;
use Domains\Category\Models\Category;

class UpsertCategoryAction
{
    public function execute(Category $category, CategoryData $categoryData): Category
    {
        $category->name = $categoryData->name;
        $category->status = $categoryData->status;
        $category->save();

        return $category;
    }
}
