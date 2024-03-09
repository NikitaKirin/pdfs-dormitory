<?php

namespace App\Services;

use App\DTO\SettlementHistory\SettlementHistoryData;
use App\Models\SettlementHistory;
use Illuminate\Support\Facades\Log;

class SettlementHistoryService
{
    public function addNewRecord(SettlementHistoryData $data): SettlementHistory
    {
        $attributes = [
            'student_id' => $data->student->id,
            'dorm_room_id' => $data->dormRoom->id,
            'settlement_status_id' => $data->settlementStatus->id,
            'user_id' => $data->user->id,
            'created_at' => $data->createdAt,
        ];
        $record = SettlementHistory::create($attributes);
        Log::channel('settlementHistory')->info('The history record with id = {id} saved', [
            'id' => $record->id,
            ...$attributes,
        ]);
        return $record;
    }
}
