<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id') ?? null; 

        return [
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $id,
            'password'   => $id ? 'nullable|min:6' : 'required|min:6',
            'phone'      => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'gender'     => 'required|in:male,female',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'bio'        => 'nullable|string',
            'status'     => 'nullable|in:1,0',
        ];
    }
}
