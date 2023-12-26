<?php

namespace App\Http\Resources\V1\AcademicGroup;

use App\Models\AcademicGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AcademicGroup */
class AcademicGroupResource extends JsonResource
{
    public static $wrap = 'academic_group';
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
        ];
    }
}
