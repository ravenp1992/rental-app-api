<?php

namespace App\Http\Requests\Api\PricePlan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertPricePlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('price_plans', 'name')->ignore($this->priceplan),
            ],
            'description' => [
                'required',
                'string',
            ],
        ];
    }
}
