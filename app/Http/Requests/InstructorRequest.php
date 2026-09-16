<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Instructor first name is required.',
            'last_name.required' => 'Instructor last name is required.',
            'email.required' => 'Instructor email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'Instructor password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'gender.required' => 'Instructor gender is required.',
            'gender.in' => 'Please select a valid gender.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'Allowed image formats: jpg, jpeg, png, webp, gif.',
            'image.max' => 'Image must not be larger than 2MB.',
        ];
    }

    public function rules(): array
    {
        $id = $this->route('id') ?? null;

        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => $id ? 'nullable|min:6' : 'required|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'bio' => 'nullable|string',
            'status' => 'nullable|in:1,0',
        ];
    }
}
