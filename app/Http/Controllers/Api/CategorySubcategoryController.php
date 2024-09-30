<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpsertCategorySubcategoryRequest;
use App\Http\Resources\SubcategoryResource;
use Domains\Category\Actions\UpsertSubcategoryAction;
use Domains\Category\DataTransferObjects\SubcategoryData;
use Domains\Category\Models\Category;
use Domains\Category\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CategorySubcategoryController extends Controller
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
    public function store(UpsertCategorySubcategoryRequest $request, Category $category): JsonResponse
    {
        return SubcategoryResource::make($this->upsert($request, $category, new Subcategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertCategorySubcategoryRequest $request, Category $category, Subcategory $subcategory): Response
    {
        $this->upsert($request, $category, $subcategory);

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

    private function upsert(UpsertCategorySubcategoryRequest $request, Category $category, Subcategory $subcategory): Subcategory
    {
        $subCategoryData = SubcategoryData::fromArray(array_merge(['category' => $category], $request->validated()));

        return $this->upsertSubcategoryAction->execute($subcategory, $subCategoryData);
    }
}
