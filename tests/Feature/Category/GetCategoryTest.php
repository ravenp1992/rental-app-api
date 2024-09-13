<?php

use App\Models\Category;

use function Pest\Laravel\getJson;

it('should return a single category', function () {
    $houseTool = Category::factory([
        'name' => 'House Tools',
    ])->create();

    $category = getJson(route('categories.show', ['category' => $houseTool]))
        ->json('data');

    expect($category)
        ->attributes->name->toBe('House Tools')
        ->attributes->slug->toBe('house-tools');
});

it('should return not found if category does not exist', function () {
    getJson(route('categories.show', ['category' => 1]))
        ->assertNotFound();
});

it('should get all categories', function () {
    Category::factory()->count(5)->create();

    $categories = getJson(route('categories.index'))
        ->json('data');

    expect($categories)->toHaveCount(5);
});

it('should filter categories', function () {
    $gardeningTools = Category::factory([
        'name' => 'Gardening Tools',
    ])->create();

    Category::factory()->count(4)->create();

    $categories = getJson(route('categories.index', [
        'filter' => [
            'name' => 'Tools',
        ],
    ]))
        ->json('data');

    expect($categories)->toHaveCount(1);
    expect($categories[0])
        ->id->toBe($gardeningTools->uuid)
        ->attributes->name->toBe('Gardening Tools')
        ->attributes->slug->toBe('gardening-tools');
});
