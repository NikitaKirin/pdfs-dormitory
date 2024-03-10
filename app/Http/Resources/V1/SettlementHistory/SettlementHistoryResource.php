<?php

namespace App\Http\Resources\V1\SettlementHistory;

use App\Http\Resources\V1\DormRoom\DormRoomResource;
use App\Http\Resources\V1\SettlementStatus\SettlementStatusResource;
use App\Http\Resources\V1\Student\StudentResource;
use App\Http\Resources\V1\User\UserResource;
use App\Models\SettlementHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SettlementHistory */
class SettlementHistoryResource extends JsonResource
{

    public static $wrap = 'settlement_history_record';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student' => StudentResource::make($this->whenLoaded('student')),
            'dorm_room' => DormRoomResource::make($this->whenLoaded('dormRoom')),
            'settlement_status' => SettlementStatusResource::make($this->whenLoaded('settlementStatus')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
