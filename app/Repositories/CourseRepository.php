<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use App\Models\User;

class CourseRepository
{
    public function getAdminFormOptions()
    {
        return [
            'categories' => Category::orderBy('name')->get(),
            'subcategories' => SubCategory::orderBy('name')->get(),
            'instructors' => User::where('role', 'instructor')->orderBy('name')->get(['id', 'name', 'email']),
        ];
    }

    public function getAdminCourses()
    {
        return Course::with(['instructor:id,name,email', 'category:id,name', 'subcategory:id,name'])
            ->select('courses.*');
    }

    public function findAdminCourse($id)
    {
        return $this->getAdminCourses()->findOrFail($id);
    }

    public function createCourse($data, $photo)
    {
        if ($photo && $photo->isValid()) {
            $data['course_image'] = upload_image($photo, 'images/courses');
        }

        return Course::create($data);
    }

    public function updateCourse($id, $data, $photo)
    {
        $course = Course::findOrFail($id);

        if ($photo && $photo->isValid()) {
            $data['course_image'] = upload_image($photo, 'images/courses');
        }

        $course->update($data);

        return $course;
    }
}
