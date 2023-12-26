<?php

namespace App\Http\Requests\Api\V1\DormRoom;

use Illuminate\Foundation\Http\FormRequest;

class IndexDormRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'int'],
            'with_user_info' => ['nullable', 'bool'],
            'only_available_dorm_rooms' => ['nullable', 'bool'],
            'is_family' => ['nullable', 'bool', 'exclude_with:gender_id'],
            'gender_id' => ['nullable', 'int', 'exists:genders,id', 'exclude_with:is_family'],
            'with_students' => ['nullable', 'bool'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
