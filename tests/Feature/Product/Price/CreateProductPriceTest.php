<?php

use Domains\Product\Models\Product;
use Domains\User\Models\User;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $user = User::factory()->create();

    $this->actingAs($user);
});

describe('Create Product Price', function () {

    it('should return 422 if productId is missing', function () {
        $product = Product::factory()->create();

        $price = postJson(route('products.price.store', compact('product')), [])
            ->assertInvalid(['productId']);
    });

    it('should return 422 if currency is', function (?string $currency) {
        $product = Product::factory()->create();

        $price = postJson(route('products.price.store', compact('product')), [
            'productId' => $product->uuid,
            'currency' => $currency,
        ])
            ->assertInvalid(['currency']);
    })->with([
        null,
        '',
    ]);

    // it('should create a price for a product', function () {
    //     $product = Product::factory()->create();

    //     $price = postJson(route('price.store', compact('product')), [
    //         'productId' => $product->uuid,
    //     ])->json('data');

    //     expect($price)
    //         ->attributes->productId->toBe($product->uuid);
    // });
});
