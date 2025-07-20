<?php

namespace App\Services;

use App\Repositories\PasswordUpdateRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordUpdateService
{
    protected $passwordUpdateRepository;

    public function __construct(PasswordUpdateRepository $passwordUpdateRepository)
    {
        $this->passwordUpdateRepository = $passwordUpdateRepository;
    }

    public function updatePassword(User $instructor, array $data): void
    {
        if (!Hash::check($data['current_password'], $instructor->password)) {
            throw new \Exception('Current password is incorrect.');
        }

        $hashedPassword = Hash::make($data['new_password']);
        $this->passwordUpdateRepository->updatePassword($instructor, $hashedPassword);
    }
}
