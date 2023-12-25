<?php

namespace App\Http\Resources\V1\Dormitory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Dormitory */
class DormitoryResourceCollection extends ResourceCollection
{
    public static $wrap = 'dormitories';

    public function toArray(Request $request): array
    {
        return [
            'dormitories' => $this->collection,
        ];
    }
}
