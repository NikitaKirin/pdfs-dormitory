<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTO\User\UpdateUserData;
use App\Models\User;

class UpdateUserAction
{
    /**
     * @param User $user
     * @param UpdateUserData $data
     * @return bool
     */
    public function run(User $user, UpdateUserData $data): bool
    {
        return $user->update(
            [
                'name' => $data->name,
                'email' => $data->email,
            ]
        );
    }
}
