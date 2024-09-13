<?php

use App\Models\Product;

use function Pest\Laravel\getJson;

it('should get a single product by id', function () {
    $tShirt = Product::factory([
        'name' => 'Tshirt',
        'description' => 'Oversize Tshirt',
    ])->create();

    $product = getJson(route('products.show', ['product' => $tShirt]))
        ->json('data');

    expect($product)
        ->attributes->name->toBe('Tshirt')
        ->attributes->description->toBe('Oversize Tshirt');
});

it('should return 404 if product not found', function () {
    getJson(route('products.show', ['product' => 1]))
        ->assertNotFound();
});

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
        ->json('data');

    expect($products)->toHaveCount(1);
    expect($products[0])->id->toBe($tshirt->uuid);
});
