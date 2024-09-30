<?php

namespace App\Http\Requests\Api;

use Domains\Product\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertProductRequest extends FormRequest
{
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
