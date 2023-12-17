<?php

namespace App\Http\Resources\V1\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Student */
class StudentResource extends JsonResource
{
    public static $wrap = 'student';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'latin_name' => $this->latin_name,
            'cyrillic_name' => $this->cyrillic_name,
            'is_family' => $this->is_family,
            'telephone' => $this->telephone,
            'eisu_id' => $this->eisu_id,
            'comment' => $this->comment,
            'gender' => $this->whenLoaded('gender', __('gender.' . $this->gender->title)),
            'creator' => $this->whenLoaded('creator', $this->creator->name),
            'last_update_user_id' => $this->whenLoaded('lastUpdateUser', $this->lastUpdateUser->name),
            'country' => $this->whenLoaded('country', $this->country->title),
            'academic_group' => $this->whenLoaded('academicGroup', $this->academicGroup->title),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
