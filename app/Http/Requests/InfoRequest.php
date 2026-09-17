<?php

namespace App\Http\Requests;

use App\Models\Info;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'icon' => ['required', Rule::in(array_keys(Info::ICONS))],
            'sort_order' => 'required|integer|min:0|max:65535',
            'status' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Info card title is required.',
            'title.max' => 'Info card title must not be longer than 100 characters.',
            'description.required' => 'Description is required.',
            'description.max' => 'Description must not be longer than 500 characters.',
            'icon.required' => 'Icon is required.',
            'icon.in' => 'Please select a valid icon.',
            'sort_order.required' => 'Sort order is required.',
            'sort_order.integer' => 'Sort order must be a whole number.',
            'sort_order.min' => 'Sort order must be at least 0.',
            'sort_order.max' => 'Sort order must not be greater than 65535.',
            'status.required' => 'Status is required.',
            'status.boolean' => 'Please select a valid status.',
        ];
    }
}
