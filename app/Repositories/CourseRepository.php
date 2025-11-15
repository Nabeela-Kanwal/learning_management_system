<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
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
