<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Role */
class RoleResourceCollection extends ResourceCollection
{
    public static $wrap = 'roles';

    public function toArray(Request $request): array
    {
        return [
            'roles' => $this->collection,
        ];
    }
}
