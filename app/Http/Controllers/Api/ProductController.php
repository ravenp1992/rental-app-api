<?php

namespace App\Http\Controllers\Api;

use App\Actions\UpsertProductAction;
use App\Data\ProductData;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\UpsertProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function __construct(private readonly UpsertProductAction $upsertProductAction) {}

    /**
     * Display a listing of the resource.
     */
    public function index(GetProductRequest $request)
    {
        /* Manual */
        // $nameFilter = $request->input('filter.name');
        // $results =
        //     Product::query()
        //         ->when(
        //             $nameFilter,
        //             fn (Builder $query) => $query->where('name', 'LIKE', "%$nameFilter%")
        //         )
        //         ->get();

        // return ProductResource::collection($results);

        /* Using spatie laravel-query-builder package */

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters(['name'])
            ->get();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertProductRequest $request): JsonResponse
    {
        return ProductResource::make($this->upsert($request, new Product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertProductRequest $request, Product $product): Response
    {
        $this->upsert($request, $product);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response()->noContent();
    }

    private function upsert(UpsertProductRequest $request, Product $product): Product
    {
        $productData = ProductData::fromRequest($request);

        return $this->upsertProductAction->execute($product, $productData);
    }
}
