<?php

namespace App\Services;

use App\DTO\SettlementHistory\SettlementHistoryData;
use App\Models\SettlementHistory;
use Illuminate\Support\Facades\Log;

class SettlementHistoryService
{
    public function addNewRecord(SettlementHistoryData $data): SettlementHistory
    {
        $attributes = $this->prepareAttributes($data);
        $record = SettlementHistory::create($attributes);
        Log::channel('settlementHistory')->info('The history record with id = {id} saved', [
            'id' => $record->id,
            ...$attributes,
        ]);
        return $record;
    }

    public function updateRecord(SettlementHistoryData $data, SettlementHistory $settlementHistory): bool
    {
        return $settlementHistory->update($this->prepareAttributes($data));
    }

    private function prepareAttributes(SettlementHistoryData $data): array
    {
        return [
            'student_id' => $data->studentId,
            'dorm_room_id' => $data->dormRoomId,
            'settlement_status_id' => $data->settlementStatusId,
            'user_id' => $data->userId,
            'created_at' => $data->createdAt,
        ];
    }
}
