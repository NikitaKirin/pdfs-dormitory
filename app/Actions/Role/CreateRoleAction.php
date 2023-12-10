<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\DTO\Role\CreateRoleData;
use App\Models\Role;

class CreateRoleAction
{
    /**
     * @param CreateRoleData $data
     * @return Role
     */
    public function run(CreateRoleData $data): Role
    {
        $role = Role::query()->create([
            'title' => $data->title,
        ]);
        $role->permissions()->sync($data->permissionIds);
        return $role;
    }
}
