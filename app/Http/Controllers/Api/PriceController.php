<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Price\UpsertPriceRequest;
use App\Http\Resources\ProductPriceResource;
use Domains\Product\Actions\UpsertProductPriceAction;
use Domains\Product\DataTransferObjects\PriceData;
use Domains\Product\Models\Price;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PriceController extends Controller
{
    public function __construct(private readonly UpsertProductPriceAction $upsertProductPriceAction) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertPriceRequest $request): JsonResponse
    {
        return ProductPriceResource::make($this->upsert($request, new Price))
            ->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertPriceRequest $request, Price $price): Response
    {
        $this->upsert($request, $price);

        return response()->noContent();
    }

    private function upsert(UpsertPriceRequest $request, Price $price): Price
    {
        $priceData = PriceData::fromArray($request->validated());

        return $this->upsertProductPriceAction->execute($price, $priceData);
    }
}
