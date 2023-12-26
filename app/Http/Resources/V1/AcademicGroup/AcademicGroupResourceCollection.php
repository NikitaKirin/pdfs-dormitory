<?php

namespace App\Http\Resources\V1\AcademicGroup;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\AcademicGroup */
class AcademicGroupResourceCollection extends ResourceCollection
{
    public static $wrap = 'academic_groups';
    public function toArray(Request $request): array
    {
        return [
            'academic_groups' => $this->collection,
        ];
    }
}
