<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PricePlan\UpsertPricePlanRequest;
use App\Http\Resources\PricePlanResource;
use Domains\Product\Actions\UpsertPricePlanAction;
use Domains\Product\DataTransferObjects\PricePlanData;
use Domains\Product\Models\PricePlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class PricePlanController extends Controller
{
    public function __construct(private readonly UpsertPricePlanAction $upsertPricePlanAction) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricePlans = QueryBuilder::for(PricePlan::class)
            ->get();

        return PricePlanResource::collection($pricePlans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertPricePlanRequest $request): JsonResponse
    {
        $pricePlan = $this->upsert($request, new PricePlan);

        return PricePlanResource::make($pricePlan)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(PricePlan $priceplan): PricePlanResource
    {
        return PricePlanResource::make($priceplan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertPricePlanRequest $request, PricePlan $priceplan): Response
    {
        $this->upsert($request, $priceplan);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricePlan $pricePlan): Response
    {
        $pricePlan->delete();

        return response()->noContent();
    }

    private function upsert(UpsertPricePlanRequest $request, PricePlan $priceplan): PricePlan
    {
        $pricePlanData = PricePlanData::fromRequest($request);

        return $this->upsertPricePlanAction->execute($priceplan, $pricePlanData);
    }
}
