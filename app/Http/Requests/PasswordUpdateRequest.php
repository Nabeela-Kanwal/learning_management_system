<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

  protected function withValidator($validator)
{
    $validator->after(function ($validator) {
        // Get authenticated user from either guard, fallback to default auth
        $user = auth('instructor')->user() ?? auth('admin')->user() ?? auth()->user();

        if (!$user) {
            $validator->errors()->add('current_password', 'User not authenticated.');
            return;
        }

        if (!Hash::check($this->current_password, $user->password)) {
            $validator->errors()->add('current_password', 'Current password is incorrect.');
        }
    });
}
}
