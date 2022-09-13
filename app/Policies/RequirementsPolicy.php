<?php

namespace App\Policies;

use App\Models\Requirements;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RequirementsPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Requirements $requirements)
    {
        if ($requirements->private == 0) {
            return true;
        }

        return $user->id === $requirements->user_id
            ? Response::allow()
            : Response::deny('No tienes acceso a este requerimiento');
    }
}
