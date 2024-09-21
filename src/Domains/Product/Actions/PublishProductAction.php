<?php

namespace Domains\Product\Actions;

use Domains\Product\Enums\ProductStatus;
use Domains\Product\Models\Product;

class PublishProductAction
{
    public function execute(Product $product): void
    {
        $product->status = ProductStatus::PUBLISHED->value;
        $product->published_at = now();

        $product->save();
    }
}
