<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DormRoom extends Model
{
    use SoftDeletes;
    use HasUser;
    use HasFactory;
    protected $fillable = [
        'number',
        'number_of_seats',
        'comment',
    ];
}
