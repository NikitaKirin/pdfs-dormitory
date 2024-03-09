<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettlementHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'dorm_room_id',
        'user_id',
        'settlement_status_id',
        'created_at'
    ];

    public function settlementStatus(): BelongsTo
    {
        return $this->belongsTo(SettlementStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function dormRoom(): BelongsTo
    {
        return $this->belongsTo(DormRoom::class);
    }
}
