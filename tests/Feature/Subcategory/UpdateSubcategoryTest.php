<?php

use Domains\Category\Models\Category;
use Domains\Category\Models\Subcategory;
use Domains\User\Models\User;

use function Pest\Laravel\putJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should update subcategory', function (string $name, string $status) {
    $category = Category::factory()->create();

    $subcategory = Subcategory::factory([
        'category_id' => $category->id,
        'name' => 'Sub Category',
    ])->create();

    putJson(route('categories.subcategories.update', compact('category', 'subcategory')), [
        'name' => $name,
        'status' => $status,
    ])
        ->assertNoContent();

    $subCategory = Subcategory::where('uuid', $subcategory->uuid)->firstOrFail();

    expect($subCategory)
        ->name->toBe($name)
        ->status->toBe($status);
})->with([
    ['name' => 'Updated Sub Category', 'status' => 'active'],
]);
