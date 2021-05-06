<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'idGroup';

    public function users()
    {
        return $this->hasMany(User::class, 'uGroup', 'idGroup');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gName',
        'gCreateFile',
        'gReadFile',
        'gUpdateFile',
        'gDeleteFile',
        'gCreateUser',
        'gReadUser',
        'gUpdateUser',
        'gDeleteUser',
        'gCreateGroup',
        'gReadGroup',
        'gUpdateGroup',
        'gDeleteGroup',
        'gCanViewTask',
        'gCanCreateTask',
        'gCanAcceptTask',
        'gCanCancelTask',
        'gCanPerformTask',
        'gCanHistoryTask',
        'gCanStatusTask',
        'gCanPageTask',
        'gCanDescriptionTask',
        'gCreateDepartment',
        'gReadDepartment',
        'gUpdateDepartment',
        'gDeleteDepartment',
    ];
}
