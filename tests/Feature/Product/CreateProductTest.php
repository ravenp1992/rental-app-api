<?php

use Domains\Category\Models\Category;
use Domains\User\Models\User;
use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should return a 422 if name is missing', function () {
    postJson(route('products.store'), [
        'name' => null,
        'description' => 'Demo description',
    ])->assertInvalid(['name']);
});

it('should return a 422 if deposit is missing', function () {
    postJson(route('products.store'), [
        'name' => 'Demo',
        'deposit' => null,
    ])->assertInvalid(['deposit']);
});

it('should return a 422 if categoryId is missing', function () {
    postJson(route('products.store'), [
        'name' => 'Demo',
        'deposit' => 1000,
    ])->assertInvalid(['categoryId']);
});

it('should create a product', function () {
    $product = postJson(route('products.store'), [
        'userId' => User::factory()->create()->uuid,
        'categoryId' => Category::factory()->create()->uuid,
        'name' => 'Demo',
        'description' => 'Demo description',
        'rentPrice' => 10 * 100,
        'deposit' => 500 * 100,
        'stockQuantity' => 5,
    ])
        ->assertStatus(Response::HTTP_CREATED)
        ->json('data');

    expect($product)
        ->attributes->name->toBe('Demo')
        ->attributes->description->toBe('Demo description')
        ->attributes->rentPrice->toBe(10 * 100)
        ->attributes->deposit->toBe(500 * 100)
        ->attributes->stockQuantity->toBe(5)
        ->attributes->status->toBe('draft');
});
