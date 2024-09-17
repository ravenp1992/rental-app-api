<?php

use App\Models\Category;
use App\Models\Subcategory;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

it('should update subcategory', function (string $name, int $isActive) {
    $category = Category::factory()->create();

    $subcategory = Subcategory::factory([
        'category_id' => $category,
        'name' => 'Sub Category',
    ])->create();

    putJson(route('subcategories.update', compact('subcategory')), [
        'name' => $name,
        'categoryId' => $category->uuid,
        'isActive' => $isActive,
    ])
        ->assertNoContent();

    $subCategory = getJson(route('subcategories.show', $subcategory->uuid))
        ->json('data');

    expect($subCategory)
        ->attributes->name->toBe($name)
        ->attributes->isActive->toBe(1);
})->with([
    ['name' => 'Updated Sub Category', 'isActive' => 1],
]);
