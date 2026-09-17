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
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'icon' => ['required', Rule::in(array_keys(Info::ICONS))],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'status' => ['required', 'boolean'],
        ];
    }
}
