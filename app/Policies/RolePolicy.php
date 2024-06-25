<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function isAdmin(User $user)
    {
        return $user->role === 'admin';
    }

    public function isLibrarian(User $user)
    {
        return $user->role === 'librarian';
    }

    public function isClient(User $user)
    {
        return $user->role === 'client';
    }
}
