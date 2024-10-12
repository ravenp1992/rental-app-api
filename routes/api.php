<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\PricePlanController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/priceplans', [PricePlanController::class, 'index'])->name('priceplans.index');
});

Route::middleware('auth:sanctum')->group(function () {
    /* categories */
    Route::apiResource('categories', CategoryController::class)->except(['index']);
    /* subcategories */
    route::apiResource('/categories/{category}/subcategories', SubcategoryController::class)->names([
        'store' => 'categories.subcategories.store',
        'update' => 'categories.subcategories.update',
    ])->only(['store', 'update']);

    /* priceplans */
    Route::apiResource('priceplans', PricePlanController::class)->except(['index']);

    /* products */
    Route::apiResource('products', ProductController::class)->except(['index']);
    Route::post('/products/{product}/publish', [ProductController::class, 'publish'])->name('products.publish');
    /* prices */
    Route::apiResource('/products/{product}/prices', PriceController::class)->names([
        'index' => 'products.prices.index',
        'store' => 'products.prices.store',
        'update' => 'products.prices.update',
    ])->only(['index', 'store', 'update']);
});
