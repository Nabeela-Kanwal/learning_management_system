<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function saveCourse(array $data, $photo = null)
    {
        return $this->courseRepository->createCourse($data, $photo);
    }

    public function updateCourse($id, array $data, $photo = null)
    {
        return $this->courseRepository->updateCourse($id, $data, $photo);
    }
}
