<?php

namespace App\Http\Resources\V1\DormRoom;

use App\Http\Resources\V1\Student\StudentResource;
use App\Http\Resources\V1\User\UserResource;
use App\Models\DormRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin DormRoom */
class DormRoomResource extends JsonResource
{
    public static $wrap = 'dorm_rooms';
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'number_of_seats' => $this->number_of_seats,
            'comment' => $this->comment,
            'students_count' => $this->whenCounted('students'),
            'empty_seats_count' => $this->whenCounted('students',
                fn() => $this->number_of_seats - $this->students_count
            ),
            'students' => StudentResource::collection($this->whenLoaded('students')),
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'last_update_user' => UserResource::make($this->whenLoaded('lastUpdateUser')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
