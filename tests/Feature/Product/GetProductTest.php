<?php

use App\Models\Product;

use function Pest\Laravel\getJson;

it('should get all products', function () {
    Product::factory()->count(5)->create();

    $products = getJson(route('products.index'))->json('data');

    expect($products)->toHaveCount(5);
});

it('should filter products', function () {
    Product::factory()->count(5)->create();

    $tshirt = Product::factory([
        'name' => 'T shirt',
    ])->create();

    $products = getJson(route('products.index', [
        'filter' => [
            'name' => 'shirt',
        ],
    ]))
        // ->dd();
        ->json('data');

    expect($products)->toHaveCount(1);
    // expect($products[0])->attributes->id->toBe($tshirt->uuid);
});
