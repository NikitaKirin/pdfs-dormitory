<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPayment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'value',
        'comment',
        'student_id',
        'student_payment_type_id',
    ];

    public function studentPaymentType(): BelongsTo
    {
        return $this->belongsTo(StudentPaymentType::class);
    }
}
