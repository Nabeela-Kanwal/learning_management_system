<?php

namespace App\Repositories;

use App\Models\User;

class PasswordUpdateRepository
{
    public function updatePassword(User $instructor, string $hashedPassword): void
    {
        $instructor->password = $hashedPassword;
        $instructor->save();
    }
}
