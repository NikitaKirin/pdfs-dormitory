<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicGroup extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];
}
