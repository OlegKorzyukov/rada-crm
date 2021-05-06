<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    protected $primaryKey = 'idFile';

    public function user()
    {
        return $this->hasOne(User::class, 'idUser', 'fCreator');
    }
    public function task()
    {
        return $this->hasOne(Task::class, 'idTask', 'fTask');
    }

    protected $fillable = [
        'fName',
        'fOriginName',
        'fCreator',
        'fTask',
        'fSize',
        'fType',
        'fDelete',
        'fLink'
    ];
}
