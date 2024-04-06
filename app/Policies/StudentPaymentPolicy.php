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
}
