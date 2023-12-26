<?php

namespace App\Http\Resources\V1\Country;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Country */
class CountryResourceCollection extends ResourceCollection
{
    public static $wrap = 'countries';
    public function toArray(Request $request): array
    {
        return [
            'countries' => $this->collection,
        ];
    }
}
