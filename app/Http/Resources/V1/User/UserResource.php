<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\Permission\PermissionResource;
use App\Http\Resources\V1\Role\RoleResource;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    /**
     * @var string
     */
    public static $wrap = 'user';

    /**
     * @param Request $request
     * @return array[]
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => $this->whenLoaded('permissions', $this->getStructuredPermissionData()),
        ];
    }

    protected function getStructuredPermissionData(): array
    {
        return $this->permissions->groupBy('model')->collect()
            ->mapWithKeys(function (Collection $permissions, string $modelName) {
                return [
                    __('model.' . $modelName) => $permissions->map(function (Permission $permission) {
                        return new PermissionResource($permission);
                    }),
                ];
            })->toArray();
    }
}
