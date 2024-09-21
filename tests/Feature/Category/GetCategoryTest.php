<?php

use App\Models\User;
use Domains\Category\Models\Category;
use Domains\Subcategory\Models\Subcategory;

use function Pest\Laravel\getJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return a category', function () {
    $houseTool = Category::factory([
        'name' => 'House Tools',
    ])->create();

    Subcategory::factory([
        'category_id' => $houseTool->id,
    ])->count(5)->create();

    $category = getJson(
        route('categories.show', [
            'category' => $houseTool,
        ])
    )
        ->json('data');

    expect($category)
        ->attributes->name->toBe('House Tools')
        ->attributes->slug->toBe('house-tools');
});

it('should return 404 if category not found', function () {
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
