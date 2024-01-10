<?php

namespace App\Http\Resources\V1\Permission;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Permission */
class PermissionResource extends JsonResource
{
    public static $wrap = 'permission';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => __('auth.permissions.' . $this->action),
            'model' =>  __('model.' . $this->model),
        ];
    }
}
