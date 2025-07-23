<?php

namespace App\Repositories;

use App\Models\User;

class ProfileRepository
{
    public function findProfile()
    {
        if (auth()->guard('instructor')->check()) {
            return auth('instructor')->user();
        }

        if (auth()->guard('admin')->check()) {
            return auth('admin')->user(); 
        }

        return null;
    }

    public function createOrUpdateProfile(array $data, $image = null)
    {
        $profile = $this->findProfile();

        if (!$profile) {
            throw new \Exception("Unauthorized: No authenticated user found.");
        }

        $profile->update($data);
        return $profile;
    }
}
