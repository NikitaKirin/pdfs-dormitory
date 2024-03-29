<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SettlementStatus extends Model
{
    public $timestamps = false;

    public const CHECK_IN = 'check-in';

    public const CHECK_OUT = 'check-out';

    protected $fillable = [
        'title',
    ];

    public function settlementHistories(): HasMany
    {
        return $this->hasMany(SettlementHistory::class);
    }
}
