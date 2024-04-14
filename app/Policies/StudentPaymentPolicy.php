<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\StudentPayment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPaymentPolicy
{
    use HandlesAuthorization;

    public function import(User $user): bool
    {
        return $user->hasPermission('import', StudentPayment::class);
    }

    public function view(User $user): bool
    {
        return $user->hasPermission('view', StudentPayment::class);
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('create', StudentPayment::class);
    }

    public function update(User $user): bool
    {
        return $user->hasPermission('update', StudentPayment::class);
    }

    public function delete(User $user): bool
    {
        return $user->hasPermission('delete', StudentPayment::class);
    }
}
