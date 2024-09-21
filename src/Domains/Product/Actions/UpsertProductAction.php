<?php

namespace Domains\Product\Actions;

use Domains\Product\DataTransferObjects\ProductData;
use Domains\Product\Models\Product;

class UpsertProductAction
{
    public function execute(Product $product, ProductData $productData): Product
    {
        $product->user_id = $productData->owner->id;
        $product->category_id = $productData->category->id;
        $product->name = $productData->name;
        $product->description = $productData->description;
        $product->rent_price = $productData->rentPrice;
        $product->buy_price = $productData->buyPrice;
        $product->deposit = $productData->deposit;
        $product->stock_quantity = $productData->stockQuantity;
        $product->status = $productData->status;
        $product->published_at = $productData->publishedAt;

        $product->save();

        return $product;
    }
}
