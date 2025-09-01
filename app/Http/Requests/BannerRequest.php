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
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2040',
            'page'        => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status'      => 'required|boolean',
        ];
    }
}
