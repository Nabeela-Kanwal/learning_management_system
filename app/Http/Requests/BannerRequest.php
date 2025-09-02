<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'image'       => 'sometimes|file|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'page'        => 'nullable|in:home,about,services,contact',
            'sort_order'  => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'Banner title is required.',
            'image.image'     => 'The file must be a valid image.',
            'image.mimes'     => 'Allowed image formats: jpg, jpeg, png, webp, gif.',
            'image.max'       => 'Image must not be larger than 2MB.',
            'page.in'         => 'Page must be one of: home, about, services, contact.',
            'status.required' => 'Status is required.',
        ];
    }
}
