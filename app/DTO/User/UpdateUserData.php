<?php

declare(strict_types=1);

namespace App\DTO\User;

class UpdateUserData
{
    /**
     * @param string $name
     * @param string $email
     */
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly bool $is_admin
    ) {
    }
}
