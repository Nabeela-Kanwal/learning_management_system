<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'role' => ['required', 'string', 'max:120'],
            'quote' => ['required', 'string', 'max:2000'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'remove_image' => ['sometimes', 'boolean'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Testimonial name is required.',
            'role.required' => 'Role is required.',
            'quote.required' => 'Quote is required.',
            'rating.required' => 'Rating is required.',
            'rating.between' => 'Rating must be between 1 and 5.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'Allowed image formats: jpg, jpeg, png, webp, gif.',
            'image.max' => 'Image must not be larger than 2MB.',
            'status.required' => 'Status is required.',
        ];
    }
}
