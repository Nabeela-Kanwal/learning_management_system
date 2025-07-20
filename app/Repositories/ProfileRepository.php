<?php

namespace App\Repositories;

use App\Models\Instructor;
use App\Models\User;

class ProfileRepository
{
    public function findProfile()
    {
        $instructorId = auth('instructor')->id();
        return User::find($instructorId);
    } 

    public function createOrUpdateProfile(array $data, $image = null)
    {
        $profile = $this->findProfile();
        $profile->update($data);
        return $profile;
    }
}
