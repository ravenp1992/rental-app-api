<?php

namespace App\Http\Requests\Api\ProductPrice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertProductPriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productId' => [
                'required',
                Rule::exists('products', 'uuid'),
            ],
            'dailyRate' => [
                'nullable',
                'sometimes',
                'integer',
            ],
            'weeklyRate' => [
                'nullable',
                'sometimes',
                'integer',
            ],
            'monthlyRate' => [
                'nullable',
                'sometimes',
                'integer',
            ],
            'buyPrice' => [
                'nullable',
                'sometimes',
                'integer',
            ],
            'currency' => [
                'sometimes',
                'string',
            ],
            'validFrom' => [
                'sometimes',
                'string',
            ],
            'validTo' => [
                'sometimes',
                'string',
            ],
        ];
    }
}
