<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'rentPrice' => ['sometimes', 'integer'],
            'buyPrice' => ['nullable', 'sometimes', 'integer'],
            'deposit' => ['sometimes', 'integer'],
            'stockQuantity' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'string'],
        ];
    }
}
