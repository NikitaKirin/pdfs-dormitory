<?php

namespace App\Http\Resources\V1\Dormitory;

use App\Http\Resources\V1\User\UserResource;
use App\Models\Dormitory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Dormitory */
class DormitoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'address' => $this->address,
            'comment' => $this->comment,
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'last_update_user' => UserResource::make($this->whenLoaded('lastUpdateUser')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
