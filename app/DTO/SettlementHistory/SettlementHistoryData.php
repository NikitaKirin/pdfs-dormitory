<?php

namespace App\DTO\SettlementHistory;

use App\Models\DormRoom;
use App\Models\SettlementStatus;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;

class SettlementHistoryData
{
    public function __construct(
        public readonly Student          $student,
        public readonly DormRoom         $dormRoom,
        public readonly SettlementStatus $settlementStatus,
        public readonly User             $user,
        public readonly Carbon           $createdAt,
    ) {}
}
