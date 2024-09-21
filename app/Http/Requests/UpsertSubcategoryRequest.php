<?php

namespace App\Http\Requests;

use Domains\Category\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpsertSubcategoryRequest extends FormRequest
{
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
            'categoryId' => [
                'required',
                'string',
                Rule::exists('categories', 'uuid'),
            ],
            'name' => [
                'required',
                'string',
            ],
            'isActive' => [
                'sometimes',
                'integer',
            ],
        ];
    }
}
