<?php

declare(strict_types=1);

namespace App\Actions\Role;

use App\DTO\Role\UpdateRoleData;
use App\Models\Role;

class UpdateRoleAction
{
    /**
     * @param Role $role
     * @param UpdateRoleData $data
     * @return bool
     */
    public function run(Role $role, UpdateRoleData $data): bool
    {
        $role->permissions()->sync($data->permissionsIds);
        return $role->update([
            'title' => $data->title,
        ]);
    }
}
