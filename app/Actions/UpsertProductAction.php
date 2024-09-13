<?php

namespace App\Actions;

use App\Data\ProductData;
use App\Models\Product;

class UpsertProductAction
{
    public function execute(Product $product, ProductData $productData): Product
    {
        $product->name = $productData->name;
        $product->description = $productData->description;
        $product->rent_price = $productData->rentPrice;
        $product->buy_price = $productData->buyPrice;
        $product->deposit = $productData->deposit;
        $product->stock_quantity = $productData->stockQuantity;
        $product->status = $productData->status;

        $product->save();

        return $product;
    }
}
