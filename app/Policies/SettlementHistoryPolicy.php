<?php

namespace App\Policies;

use App\Models\SettlementHistory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettlementHistoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->hasPermission('view', SettlementHistory::class);
    }

    public function create(User $user): bool {
        return $user->hasPermission('create', SettlementHistory::class);
    }

    public function update(User $user): bool {
        return $user->hasPermission('update', SettlementHistory::class);
    }

    public function delete(User $user): bool {
        return $user->hasPermission('delete', SettlementHistory::class);
    }
}
