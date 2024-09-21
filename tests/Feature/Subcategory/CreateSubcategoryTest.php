<?php

use Domains\Category\Models\Category;
use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return 422 if categoryId is missing', function () {
    postJson(route('subcategories.store'), [
        'name' => 'fastener',
    ])
        ->assertInvalid(['categoryId']);
});

it('should return 422 if name is missing', function () {
    postJson(route('subcategories.store'), [
        'categoryId' => Category::factory()->create()->uuid,
    ])
        ->assertInvalid(['name']);
});

it('should create a sub category', function () {
    $subCategory = postJson(route('subcategories.store'), [
        'categoryId' => Category::factory()->create()->uuid,
        'name' => 'fastener',
    ])
        ->assertStatus(Response::HTTP_CREATED)
        ->json('data');

    expect($subCategory)
        ->attributes->name->toBe('fastener');
});
