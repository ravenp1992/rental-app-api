<?php

use App\Models\User;
use Domains\Category\Models\Category;
use Domains\Product\Models\Product;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('should update a product', function () {
    $category = Category::factory()->create();

    $product = Product::factory([
        'category_id' => $category->id,
        'name' => 'Demo',
        'description' => 'Demo Product',
        'rent_price' => 10 * 100,
        'deposit' => 500 * 100,
        'stock_quantity' => 2,
    ])->create();

    putJson(route('products.update', ['product' => $product]), [
        'categoryId' => $category->uuid,
        'name' => 'Updated Name',
        'description' => 'Demo Product',
        'rentPrice' => 10 * 100,
        'deposit' => 500 * 100,
        'stockQuantity' => 2,
    ])->assertNoContent();

    $product = getJson(route('products.show', compact('product')))->json('data');

    expect($product)->attributes->name->toBe('Updated Name');
});
