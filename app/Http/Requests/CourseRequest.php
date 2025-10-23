<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id'        => 'required|integer|exists:categories,id',
            'subcategory_id'     => 'required|integer|exists:sub_categories,id',
            'instructor_id'      => 'required|integer|exists:users,id',

            'course_title'       => 'required|string|max:255',
            'course_slug'        => 'nullable|string|max:255|unique:courses,course_slug',
            'course_name'        => 'nullable|string|max:255',
            'course_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'course_description' => 'nullable|string',
            'video_url'          => 'nullable|url|max:255',
            'label'              => 'nullable|string|max:100',
            'resources'          => 'nullable|string|max:255',
            'certificate'        => 'nullable|string|max:255',

            'selling_price'      => 'nullable|numeric|min:0',
            'discount_price'     => 'nullable|numeric|min:0|lte:selling_price',

            'prerequisites'      => 'nullable|string|max:500',

            'best_seller'        => 'nullable|in:1,0',
            'featured'           => 'nullable|in:1,0',
            'hightest_rated'     => 'nullable|in:1,0',

            'status'             => 'required|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category.',
            'subcategory_id.required' => 'Please select a subcategory.',
            'instructor_id.required' => 'Please select an instructor.',

            'course_title.required' => 'Course title is required.',
            'course_slug.unique' => 'This course slug already exists. Please use a unique slug.',
            'course_image.image' => 'Only image files are allowed for course image.',
            'course_image.max' => 'Image size must be under 2MB.',

            'video_url.url' => 'Please provide a valid video URL.',
            'discount_price.lte' => 'Discount price must be less than or equal to selling price.',

            'status.required' => 'Please select a course status.',
        ];
    }
}
