<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $categoryId = $this->route('id');

        $isUpdate = $this->isMethod('put');

        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($categoryId),
            ],
            'image' => $isUpdate
                ? ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048']
                : ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'status' => 'required|in:0,1',
        ];
    }
}
