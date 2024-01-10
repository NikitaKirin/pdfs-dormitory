<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Role;

use App\Http\Resources\V1\Permission\PermissionResource;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Role */
class RoleResource extends JsonResource
{
    public static $wrap = 'role';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'permissions' => PermissionResource::collection($this->whenLoaded('permissions')),
        ];
    }
}
