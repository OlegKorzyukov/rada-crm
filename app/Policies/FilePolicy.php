<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
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
    public function createFile(User $user)
    {
        return (int)$user->group->gCreateFile === 1;
    }
    public function readFile(User $user)
    {
        return (int)$user->group->gReadFile === 1;
    }
    public function updateFile(User $user)
    {
        return (int)$user->group->gUpdateFile === 1;
    }
    public function deleteFile(User $user)
    {
        return (int)$user->group->gDeleteFile === 1;
    }
}
