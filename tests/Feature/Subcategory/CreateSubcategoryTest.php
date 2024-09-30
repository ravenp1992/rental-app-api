<?php

use Domains\Category\Models\Category;
use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

describe('Create Category Subcategory', function () {

    it('should return 422 if name is missing', function () {
        $category = Category::factory()->create();

        postJson(route('categories.subcategories.store', compact('category')), [
            'categoryId' => Category::factory()->create()->uuid,
        ])
            ->assertInvalid(['name']);
    });

    it('should create a sub category', function () {
        $category = Category::factory()->create();

        $subCategory = postJson(route('categories.subcategories.store', compact('category')), [
            'name' => 'fastener',
        ])
            ->assertStatus(Response::HTTP_CREATED)
            ->json('data');

        expect($subCategory)
            ->attributes->name->toBe('fastener');
    });
});
