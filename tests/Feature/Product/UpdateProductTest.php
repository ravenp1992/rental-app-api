<?php

use App\Models\Product;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

it('should update a product', function () {
    $product = Product::factory([
        'name' => 'Demo',
        'description' => 'Demo Product',
        'rent_price' => 10 * 100,
        'deposit' => 500 * 100,
        'stock_quantity' => 2,
    ])->create();

    putJson(route('products.update', ['product' => $product]), [
        'name' => 'Updated Name',
        'description' => 'Demo Product',
        'rentPrice' => 10 * 100,
        'deposit' => 500 * 100,
        'stockQuantity' => 2,
    ])->assertNoContent();

    $product = getJson(route('products.show', compact('product')))->json('data');

    expect($product)->attributes->name->toBe('Updated Name');
});
