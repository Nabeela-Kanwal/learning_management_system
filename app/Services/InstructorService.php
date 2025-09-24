<?php

namespace App\Services;

use App\Repositories\InstructorRepository;

class InstructorService
{
    protected $instructorRepository;

    public function __construct(InstructorRepository $instructorRepository)
    {
        $this->instructorRepository = $instructorRepository;
    }

    public function saveInstructor(array $data, $photo = null)
    {
        return $this->instructorRepository->createInstructor($data, $photo);
    }

    public function updateInstructor($id, array $data, $photo = null)
    {
        return $this->instructorRepository->updateInstructor($id, $data, $photo);
    }
}
