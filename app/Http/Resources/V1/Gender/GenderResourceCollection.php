<?php

namespace App\Http\Resources\V1\Gender;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Gender */
class GenderResourceCollection extends ResourceCollection
{
    public static $wrap = 'genders';
    public function toArray(Request $request): array
    {
        return [
            'genders' => $this->collection,
        ];
    }
}
