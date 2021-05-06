<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
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
        return (int)$user->group->gReadDepartment === 1;
    }
    public function create(User $user)
    {
        return (int)$user->group->gCreateDepartment  === 1;
    }
    public function update(User $user)
    {
        return (int)$user->group->gUpdateDepartment  === 1;
    }
    public function delete(User $user)
    {
        return (int)$user->group->gDeleteDepartment  === 1;
    }
}
