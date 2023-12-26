<?php

namespace App\Http\Resources\V1\Student;

use App\Http\Resources\V1\AcademicGroup\AcademicGroupResource;
use App\Http\Resources\V1\Country\CountryResource;
use App\Http\Resources\V1\DormRoom\DormRoomResource;
use App\Http\Resources\V1\Gender\GenderResource;
use App\Http\Resources\V1\User\UserResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Student */
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
            'gender' => GenderResource::make($this->whenLoaded('gender')),
            'creator' => UserResource::make($this->whenLoaded('creator')),
            'last_update_user_id' => UserResource::make($this->whenLoaded('lastUpdateUser')),
            'country' => CountryResource::make($this->whenLoaded('country')),
            'academic_group' => AcademicGroupResource::make($this->whenLoaded('academicGroup')),
            'dorm_room' => DormRoomResource::make($this->whenLoaded('dormRoom')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
