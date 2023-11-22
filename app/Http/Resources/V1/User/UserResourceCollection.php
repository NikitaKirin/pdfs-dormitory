<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\User */
class UserResourceCollection extends ResourceCollection
{
    public static $wrap = 'users';
    public function toArray(Request $request): array
    {
        return [
            'users' => $this->collection,
        ];
    }
}
