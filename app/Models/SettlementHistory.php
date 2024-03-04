<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettlementHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
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
}
