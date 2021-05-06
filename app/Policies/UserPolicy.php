<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\UserController;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user)
    {
        return (int)$user->group->gReadUser === 1;
    }
    public function create(User $user)
    {
        return (int)$user->group->gCreateUser === 1;
    }
    public function view(User $user)
    {
        return (int)$user->group->gReadUser === 1;
    }
    public function update(User $user)
    {
        return (int)$user->group->gUpdateUser === 1;
    }
    public function delete(User $user)
    {
        return (int)$user->group->gDeleteUser === 1;
    }
}
