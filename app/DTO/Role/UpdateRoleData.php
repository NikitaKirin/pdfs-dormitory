<?php

declare(strict_types=1);

namespace App\DTO\Role;

class UpdateRoleData
{
    public function __construct(
        public readonly string $title,
        public readonly array $permissionsIds,
    ) {

    }
}
