<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->hasPermission('view', Role::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create', Role::class);
    }

    public function update(User $user): bool
    {
        return $user->hasPermission('update', Role::class);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermission('delete', Role::class);
    }

}
