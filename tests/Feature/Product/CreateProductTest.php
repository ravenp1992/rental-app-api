<?php

use Illuminate\Http\Response;

use function Pest\Laravel\postJson;

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

it('should create a product', function () {
    $product = postJson(route('products.store'), [
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
