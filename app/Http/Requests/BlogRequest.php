<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs', 'slug')->ignore($id)],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'author' => ['nullable', 'string', 'max:100'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['nullable', 'in:1,0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Blog title is required.',
            'description.required' => 'Blog description is required.',
            'slug.unique' => 'This blog slug is already in use.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'Allowed image formats: jpg, jpeg, png, webp, gif.',
            'image.max' => 'Image must not be larger than 2MB.',
        ];
    }
}
