<?php

namespace App\Http\Resources\V1\SettlementStatus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\SettlementStatus */
class SettlementStatusResourceCollection extends ResourceCollection
{
    public static $wrap = 'settlement_statuses';

    public function toArray(Request $request): array
    {
        return [
            'settlement_statuses' => $this->collection,
        ];
    }
}
