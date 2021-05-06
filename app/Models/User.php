<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'idUser';

    public function group()
    {
        return $this->hasOne(Group::class, 'idGroup', 'uGroup');
    }
    public function department()
    {
        return $this->hasOne(Department::class, 'idDepartment', 'uDepartment');
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function history()
    {
        return $this->hasMany(History::class);
    }


    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->uPass;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uName',
        'uLogin',
        'uGroup',
        'uAvatar',
        'uPass',
        'uPosition',
        'uDepartment',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'uPass',
        'remember_token',
        'uActive',
        'updated_at',
        'created_at',
    ];
}
