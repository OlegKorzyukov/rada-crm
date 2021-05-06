<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $primaryKey = 'idTask';

    public function files()
    {
        return $this->hasMany(File::class, 'fTask', 'idTask');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'idUser', 'tInitiator');
    }

    protected $fillable = [
        'tNumber',
        'tSignName',
        'tStatus',
        'tInitiator',
        'tAcceptChief',
        'tExecutor',
        'tDescription',
        'tCreateTime',
        'tChiefAcceptTime',
        'tCloseTime',
        'tExecutorGetDate',
        'tCancelIniciator',
        'tWorkTime',
        'tPage',
        'tSitePath',
        'tSiteLink',
        'tLink',
    ];
}
