<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Get the sub-category route parameter
        $subCategory = $this->route('id'); // matches {id} in your route
        $subCategoryId = is_object($subCategory) ? $subCategory->id : $subCategory;

        $rules = [];

        if ($this->isMethod('post')) {
            // Creating a new sub-category
            $rules['name'] = 'required|string|max:255';
            $rules['slug'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'slug'),
            ];
            $rules['category_id'] = 'required|exists:categories,id';
        } else {
            // Updating an existing sub-category
            $rules['name'] = 'sometimes|string|max:255';
            $rules['slug'] = [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'slug')->ignore($subCategoryId, 'id'),
            ];
            $rules['category_id'] = 'sometimes|exists:categories,id';
        }

        return $rules;
    }
}
