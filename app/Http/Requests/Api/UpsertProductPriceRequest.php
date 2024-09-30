<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
            'dailyRate' => [
                'sometimes',
                'numeric',
                'min:1',
            ],
            'weeklyRate' => [
                'sometimes',
                'numeric',
                'min:1',
            ],
            'monthlyRate' => [
                'sometimes',
                'numeric',
                'min:1',
            ],
            'buyPrice' => [
                'nullable',
                'sometimes',
                'numeric',
                'min:1',
            ],
            'currency' => [
                'sometimes',
                'string',
                'max:3',
            ],
            'validFrom' => [
                'sometimes',
                'date',
                'date_format:Y-m-d',
                'before:validTo',
            ],
            'validTo' => [
                'sometimes',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:validTo',
            ],
        ];
    }
}
