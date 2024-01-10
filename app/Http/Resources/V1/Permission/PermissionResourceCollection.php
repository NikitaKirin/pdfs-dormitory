<?php

namespace App\Http\Resources\V1\Permission;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see Permission */
class PermissionResourceCollection extends ResourceCollection
{
    public static $wrap = 'permissions';
    public function toArray(Request $request): array
    {
        return [
            'permissions' => $this->collection,
        ];
    }
}
