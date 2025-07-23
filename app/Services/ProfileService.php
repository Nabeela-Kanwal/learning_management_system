<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function updateUserProfile(array $data, $image = null)
    {
        $instructor = $this->profileRepository->findProfile();

        if ($image) {
            $oldPath = 'images/profile/' . $instructor->image;
            if ($instructor->image && file_exists(public_path($oldPath))) {
                unlink(public_path($oldPath));
            }

            $filename = upload_image($image, 'images/profile');
            $data['image'] = $filename;
        }

        return $this->profileRepository->createOrUpdateProfile($data);
    }


}
