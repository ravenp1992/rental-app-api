<?php

use Domains\Product\Enums\ProductStatus;
use Domains\Product\Models\Product;
use Domains\User\Models\User;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();

    $this->actingAs($user);
});

it('should publish a product', function () {
    $product = Product::factory([
        'name' => 'Test Product',
    ])->create();

    expect($product)
        ->status->toBe(ProductStatus::DRAFT->value);

    postJson(route('products.publish', compact('product')))
        ->assertNoContent();

    $product = getJson(route('products.show', compact('product')))
        ->json('data');

    expect($product)
        ->attributes->status->toBe('published')
        ->attributes->publishedAt->not->toBeNull();
});
