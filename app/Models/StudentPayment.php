<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,
        );
    }


    public function studentPaymentType(): BelongsTo
    {
        return $this->belongsTo(StudentPaymentType::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
