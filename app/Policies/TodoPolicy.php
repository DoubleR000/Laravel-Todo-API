<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function own(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
