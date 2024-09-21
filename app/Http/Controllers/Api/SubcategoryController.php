<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpsertSubcategoryRequest;
use App\Http\Resources\SubcategoryResource;
use Domains\Subcategory\Actions\UpsertSubcategoryAction;
use Domains\Subcategory\DataTransferObjects\SubcategoryData;
use Domains\Subcategory\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class SubcategoryController extends Controller
{
    public function __construct(private readonly UpsertSubcategoryAction $upsertSubcategoryAction)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QueryBuilder::for(Subcategory::class)
            ->allowedIncludes(['category'])
            ->get();

        return SubcategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertSubcategoryRequest $request): JsonResponse
    {
        return SubcategoryResource::make($this->upsert($request, new Subcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory): SubcategoryResource
    {
        $subcategory = QueryBuilder::for(Subcategory::class)
            ->allowedIncludes(['category'])
            ->findOrFail($subcategory->id);

        return SubcategoryResource::make($subcategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertSubcategoryRequest $request, Subcategory $subcategory): Response
    {
        $this->upsert($request, $subcategory);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory): Response
    {
        $subcategory->delete();

        return response()->noContent();
    }

    private function upsert(UpsertSubcategoryRequest $request, Subcategory $subcategory): Subcategory
    {
        $subCategoryData = SubcategoryData::fromRequest($request);

        return $this->upsertSubcategoryAction->execute($subcategory, $subCategoryData);
    }
}
