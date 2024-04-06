<?php

namespace App\Models;

use App\Enums\StudentPaymentTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentPaymentType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    protected $casts = [
        'title' => StudentPaymentTypeEnum::class,
    ];

    public function studentPayments(): HasMany
    {
        return $this->hasMany(StudentPayment::class);
    }
}
