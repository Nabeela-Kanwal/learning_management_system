<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InstructorRepository
{
    public function createInstructor(array $data, $photo = null)
    {
        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/users');
        } else {
            $data['image'] = 'default.png';
        }

        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['role'] = 'instructor';
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }


    public function updateInstructor($id, array $data, $photo = null)
    {
        $instructor = User::findOrFail($id);

        if ($photo && $photo->isValid()) {
            $data['image'] = upload_image($photo, 'images/users');
        }

        if (isset($data['first_name']) && isset($data['last_name'])) {
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $instructor->update($data);

        return $instructor;
    }
}
