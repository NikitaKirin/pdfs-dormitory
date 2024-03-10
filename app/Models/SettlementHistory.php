<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettlementHistory extends Model
{
    use SoftDeletes;

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

    public function scopeOfStudent(Builder $query, int $studentId): void
    {
        $query->where('student_id', $studentId);
    }

    public function scopeOfDormRoom(Builder $query, int $dormRoomId): void
    {
        $query->where('dorm_room_id', $dormRoomId);
    }

    public function scopeOfSettlementStatus(Builder $query, int $settlementStatusId): void
    {
        $query->where('settlement_status_id', $settlementStatusId);
    }
}
