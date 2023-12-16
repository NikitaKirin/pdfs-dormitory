<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DormRoom extends Model
{
    use SoftDeletes;
    use HasUser;

    protected $fillable = [
        'number',
        'number_of_seats',
        'comment',
    ];
}
