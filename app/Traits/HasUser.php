<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
 * @method belongsTo
 */

trait HasUser
{
    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongTo(User::class, 'creator_id');
    }

    /**
     * @return BelongsTo
     */
    public function lastUpdateUser(): BelongsTo
    {
        return $this->belongTo(User::class, 'last_update_user_id');
    }
}
