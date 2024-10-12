<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpsertPriceRequest;
use App\Http\Resources\ProductPriceResource;
use Domains\Product\Actions\UpsertPriceAction;
use Domains\Product\DataTransferObjects\PriceData;
use Domains\Product\Models\Price;
use Domains\Product\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PriceController extends Controller
{
    public function __construct(private readonly UpsertPriceAction $upsertProductPriceAction) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertPriceRequest $request, Product $product): JsonResponse
    {
        return ProductPriceResource::make($this->upsert($request, $product, new Price))
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertPriceRequest $request, Product $product, Price $price): Response
    {
        $this->upsert($request, $product, $price);

        return response()->noContent();
    }

    private function upsert(UpsertPriceRequest $request, Product $product, Price $price): Price
    {
        $priceData = PriceData::fromArray(array_merge(['product' => $product], $request->validated()));

        return $this->upsertProductPriceAction->execute($price, $priceData);
    }
}
