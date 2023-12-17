<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dormitory extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;

    protected $fillable = [
        'number',
        'address',
        'comment',
    ];
}
