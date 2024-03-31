<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentPaymentType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function studentPayments(): HasMany
    {
        return $this->hasMany(StudentPaymentType::class);
    }
}
