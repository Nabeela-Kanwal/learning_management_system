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

    public function updateUserPassword(User $user, array $data): void
    {
        if (!$this->isAllowedRole($user)) {
            throw new \Exception('Unauthorized role for password update.');
        }

        $hashedPassword = Hash::make($data['new_password']);
        $this->passwordUpdateRepository->updateUserPassword($user, $hashedPassword);
    }

    /**
     * Check if the user's role is allowed to update password.
     */
    protected function isAllowedRole(User $user): bool
    {
        // You can customize allowed roles here
        $allowedRoles = ['admin', 'instructor'];

        return in_array($user->role, $allowedRoles);
    }
}
