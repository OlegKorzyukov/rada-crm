<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return (int)$user->group->gCanViewTask === 1;
    }
    public function create(User $user)
    {
        return (int)$user->group->gCanCreateTask === 1;
    }
    public function accept(User $user)
    {
        return (int)$user->group->gCanAcceptTask === 1;
    }
    public function cancel(User $user)
    {
        return (int)$user->group->gCanCancelTask === 1;
    }
    public function perform(User $user)
    {
        return (int)$user->group->gCanPerformTask === 1;
    }
    public function history(User $user)
    {
        return (int)$user->group->gCanHistoryTask === 1;
    }
    public function status(User $user)
    {
        return (int)$user->group->gCanStatusTask === 1;
    }
    public function page(User $user)
    {
        return (int)$user->group->gCanPageTask === 1;
    }
    public function description(User $user)
    {
        return (int)$user->group->gCanDescriptionTask === 1;
    }
}
