<?php

namespace App\Http\Resources\V1\SettlementStatus;

use App\Models\SettlementStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SettlementStatus */
class SettlementStatusResource extends JsonResource
{
    public static $wrap = 'settlement_status';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => __($this->title),
        ];
    }
}
