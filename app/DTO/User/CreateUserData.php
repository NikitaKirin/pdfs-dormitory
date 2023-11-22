<?php

declare(strict_types=1);

namespace App\DTO\User;

class CreateUserData
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
