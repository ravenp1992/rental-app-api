<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\UpsertCategoryRequest;
use App\Http\Resources\CategoryResource;
use Domains\Category\Actions\UpserCategoryAction;
use Domains\Category\DataTransferObjects\CategoryData;
use Domains\Category\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function __construct(private readonly UpserCategoryAction $upserCategoryAction) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFilters(['name'])
            ->allowedIncludes(['subCategories'])
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpsertCategoryRequest $request): JsonResponse
    {
        return CategoryResource::make($this->upsert($request, new Category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryResource
    {
        $category = QueryBuilder::for(Category::class)
            ->allowedIncludes(['subCategories'])
            ->findOrFail($category->id);

        return CategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpsertCategoryRequest $request, Category $category): Response
    {
        $this->upsert($request, $category);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }

    private function upsert(UpsertCategoryRequest $request, Category $category): Category
    {
        $categoryData = CategoryData::fromArray($request->validated());

        return $this->upserCategoryAction->execute($category, $categoryData);
    }
}
