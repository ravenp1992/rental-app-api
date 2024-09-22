<?php

use Domains\Category\Models\Category;
use Domains\Product\Models\Product;
use Domains\User\Models\User;

use function Pest\Laravel\getJson;
use function Pest\Laravel\putJson;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

it('should update a product', function () {
    $category = Category::factory()->create();

    $product = Product::factory([
        'user_id' => $this->user->id,
        'category_id' => $category->id,
        'name' => 'Demo',
        'description' => 'Demo Product',
        'rent_price' => 10 * 100,
        'deposit' => 500 * 100,
        'stock_quantity' => 2,
    ])->create();

    putJson(route('products.update', ['product' => $product]), [
        'userId' => $this->user->uuid,
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

it('should return a 403 if user is not the owner of product', function () {
    $category = Category::factory()->create();

    $product = Product::factory([
        'user_id' => $this->user->id,
        'category_id' => $category->id,
        'name' => 'Demo',
        'description' => 'Demo Product',
        'rent_price' => 10 * 100,
        'deposit' => 500 * 100,
        'stock_quantity' => 2,
    ])->create();

    $otherUser = User::factory()->create();

    $this->actingAs($otherUser)->putJson(route('products.update', compact('product')), [
        'userId' => $otherUser->uuid,
        'categoryId' => $category->uuid,
        'name' => 'Updated Name',
        'description' => 'Demo Product',
        'rentPrice' => 10 * 100,
        'deposit' => 500 * 100,
        'stockQuantity' => 2,
    ])->assertForbidden();
});
