<?php

namespace App\Http\Resources\V1\SettlementHistory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\SettlementHistory */
class SettlementHistoryResourceCollection extends ResourceCollection
{
    public static $wrap = 'settlement_history_records';

    public function toArray(Request $request): array
    {
        return [
            'settlement_history_records' => $this->collection,
        ];
    }
}
