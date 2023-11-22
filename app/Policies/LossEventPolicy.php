<?php

namespace App\Policies;

use App\Models\User;

class LossEventPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        //
    }
}
