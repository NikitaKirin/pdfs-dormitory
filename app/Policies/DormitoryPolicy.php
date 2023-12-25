<?php

namespace App\Policies;

use App\Models\Dormitory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DormitoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->hasPermission('view', Dormitory::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create', Dormitory::class);
    }

    public function update(User $user): bool
    {
        return $user->hasPermission('create', Dormitory::class);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermission('delete', Dormitory::class);
    }
}
