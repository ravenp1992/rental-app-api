<?php

use App\Models\Category;

use function Pest\Laravel\putJson;

it('it should return an updated category', function (string $name, int $isActive) {
    $category = Category::factory([
        'name' => 'tools',
    ])->create();

    putJson(route('categories.update', compact('category')), [
        'name' => $name,
        'isActive' => $isActive,
    ])->assertNoContent();

    expect(Category::find($category->id))
        ->name->toBe($name)
        ->is_active->toBe($isActive);
})->with([
    ['name' => 'tools', 'isActive' => 1],
    ['name' => 'tools updated', 'isActive' => 0],
]);
