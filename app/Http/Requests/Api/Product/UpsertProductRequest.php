<?php

namespace App\Http\Requests\Api\Product;

use Domains\Category\Models\Category;
use Domains\Product\Enums\ProductStatus;
use Domains\User\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertProductRequest extends FormRequest
{
    public function getOwner(): User
    {
        return User::where('uuid', $this->userId)->firstOrFail();
    }

    public function getCategory(): Category
    {
        return Category::where('uuid', $this->categoryId)->firstOrFail();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Product
            'userId' => [
                'required',
                'string',
                Rule::exists('users', 'uuid'),
            ],
            'categoryId' => [
                'required',
                'string',
                Rule::exists('categories', 'uuid'),
            ],
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'deposit' => ['sometimes', 'integer'],
            'stockQuantity' => ['sometimes', 'integer'],
            'status' => ['sometimes', Rule::enum(ProductStatus::class)],
            'publishedAt' => ['sometimes', 'string'],

            // Price
            'dailyRate' => ['nullable', 'sometimes', 'integer'],
            'weeklyRate' => ['nullable', 'sometimes', 'integer'],
            'monthlyRate' => ['nullable', 'sometimes', 'integer'],
            'buyPrice' => ['nullable', 'sometimes', 'integer'],
            'currency' => ['sometimes', 'string'],
            'validFrom' => ['sometimes', 'date'],
            'validTo' => ['sometimes', 'date'],
        ];
    }
}
