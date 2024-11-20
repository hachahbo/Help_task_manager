<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user)
    {
        // admin --> HamzaAdmin
        return $user->email === 'HamzaAdmin@gmail.com'; 
    }
}
