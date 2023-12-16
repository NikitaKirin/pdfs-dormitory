<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\V1\Permission\PermissionResourceCollection;
use App\Http\Resources\V1\Role\RoleResource;
use App\Models\User;
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => $this->whenLoaded('permissions',
                PermissionResourceCollection::getStructuredPermissionData($this->permissions->groupBy('model'))),
        ];
    }
}
