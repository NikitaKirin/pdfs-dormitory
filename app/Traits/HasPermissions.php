<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method belongsToMany(string $class)
 * @property Collection<Role> roles
 * @property Collection<Permission> permissions
 */
trait HasPermissions
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param string $action
     * @param string $model
     * @return bool
     */
    public function hasPermission(string $action, string $model): bool
    {
        return $this->is_admin
            || $this->hasDirectPermission($action, $model)
            || $this->hasRolePermissions($action, $model);
    }

    /**
     * @param string $action
     * @param string $model
     * @return bool
     */
    public function hasDirectPermission(string $action, string $model): bool
    {
        return $this->permissions
            ->where('action', $action)
            ->where('model', $model)
            ->isNotEmpty();
    }

    /**
     * @param string $action
     * @param string $model
     * @return bool
     */
    public function hasRolePermissions(string $action, string $model): bool
    {
        $this->roles->loadMissing('permissions');

        foreach ($this->roles as $role) {
            $exists = $role->permissions
                ->where('action', $action)
                ->where('model', $model)
                ->isNotEmpty();

            if ($exists) {
                return true;
            }
        }

        return false;
    }
}
