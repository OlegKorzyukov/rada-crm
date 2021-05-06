<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return (int)$user->group->gReadGroup === 1;
    }

    public function view(User $user)
    {
        return (int)$user->group->gReadGroup === 1;
    }

    public function create(User $user)
    {
        return (int)$user->group->gCreateGroup === 1;
    }

    public function update(User $user)
    {
        return (int)$user->group->gUpdateGroup === 1;
    }

    public function delete(User $user)
    {
        return (int)$user->group->gDeleteGroup === 1;
    }
}
