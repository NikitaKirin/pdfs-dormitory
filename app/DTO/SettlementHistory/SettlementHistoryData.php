<?php

namespace App\DTO\SettlementHistory;

class SettlementHistoryData
{
    public function __construct(
        public readonly int    $studentId,
        public readonly int    $dormRoomId,
        public readonly int    $settlementStatusId,
        public readonly int|null    $userId,
        public readonly string $createdAt,
    ) {}
}
