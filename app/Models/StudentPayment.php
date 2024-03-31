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
    ];

    public function studentPaymentType(): BelongsTo
    {
        return $this->belongsTo(StudentPaymentType::class);
    }
}
