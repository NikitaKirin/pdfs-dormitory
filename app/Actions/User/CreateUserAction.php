<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTO\User\CreateUserData;
use App\Models\User;

class CreateUserAction
{
    /**
     * @param CreateUserData $createUserData
     * @return User
     */
    public function run(CreateUserData $createUserData): User
    {
        $user = User::query()->create(
            [
                'name' => $createUserData->name,
                'email' => $createUserData->email,
                'password' => bcrypt($createUserData->password),
                'is_admin' => $createUserData->is_admin,
            ]
        );
        $user->roles()->sync($createUserData->roleIds);
        $user->permissions()->sync($createUserData->permissionIds);
        return $user;
    }
}
