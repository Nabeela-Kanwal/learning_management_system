<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AdminCourseRequest extends CourseRequest
{
    public function rules(): array
    {
        return array_replace(parent::rules(), [
            'course_slug' => ['nullable', 'string', 'max:255', Rule::unique('courses', 'course_slug')->ignore((int) $this->route('id'))],
            'instructor_id' => ['required', 'integer', Rule::exists('users', 'id')->where('role', 'instructor')],
            'subcategory_id' => ['required', 'integer', Rule::exists('sub_categories', 'id')->where('category_id', $this->input('category_id'))],
        ]);
    }
}
