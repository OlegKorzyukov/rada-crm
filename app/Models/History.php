<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $primaryKey = 'idHistory';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
