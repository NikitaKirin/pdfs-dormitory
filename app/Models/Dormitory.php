<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dormitory extends Model
{
    use SoftDeletes;
    use HasUser;

    protected $fillable = [
        'number',
        'address',
        'comment',
    ];
}
