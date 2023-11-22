<?php

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
        return User::query()->create([
                'name' => $createUserData->name,
                'email' => $createUserData->email,
                'password' => bcrypt($createUserData->password),
            ]
        );
    }
}
