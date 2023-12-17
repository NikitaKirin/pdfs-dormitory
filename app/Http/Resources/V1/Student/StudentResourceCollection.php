<?php

namespace App\Http\Resources\V1\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Student */
class StudentResourceCollection extends ResourceCollection
{
    public static $wrap = 'students';
    public function toArray(Request $request): array
    {
        return [
            'students' => $this->collection,
        ];
    }
}
