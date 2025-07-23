<?php

namespace App\Repositories;

use App\Models\User;

class PasswordUpdateRepository
{
    public function updateUserPassword(User $user, string $hashedPassword): void
    {
        // Optionally check role here if needed
        if (!in_array($user->role, ['admin', 'instructor'])) {
            throw new \Exception('User role not authorized to update password.');
        }

        $user->password = $hashedPassword;
        $user->save();
    }
}
