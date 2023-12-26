<?php

namespace App\Http\Resources\V1\DormRoom;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\DormRoom */
class DormRoomResourceCollection extends ResourceCollection
{
    public static $wrap = 'dorm_rooms';
    public function toArray(Request $request): array
    {
        return [
            'dorm_rooms' => $this->collection,
        ];
    }
}
