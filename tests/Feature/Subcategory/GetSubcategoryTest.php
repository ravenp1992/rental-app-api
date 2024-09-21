<?php

use Domains\Category\Models\Category;
use Domains\Subcategory\Models\Subcategory;
use Domains\User\Models\User;

use function Pest\Laravel\getJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return a subcategory', function () {
    $testCategory = Subcategory::factory([
        'category_id' => Category::factory()->create(),
        'name' => 'test',
        'is_active' => 1,
    ])->create();

    $subCategory = getJson(route('subcategories.show', ['subcategory' => $testCategory]))
        ->json('data');

    expect($subCategory)
        ->attributes->name->toBe('test');
});

it('should includes subcategory category', function () {
    $testCategory = Subcategory::factory([
        'category_id' => Category::factory()->create(),
        'name' => 'test',
        'is_active' => 1,
    ])->create();

    $subCategory = getJson(
        route('subcategories.show', [
            'subcategory' => $testCategory,
            'include' => 'category',
        ]),
    )
        ->json();

    expect($subCategory)->toHaveKeys(['data', 'included']);
    expect($subCategory)->included->toHaveCount(1);
});
