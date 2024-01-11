<?php

namespace App\Http\Requests\Api\V1\DormRoom;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'number' => ['nullable', 'integer'],
            /**
             * @example sort_by[column]=number&sort_by[direction]=asc
             */
            'sort_by' => ['nullable', 'array:column,direction', 'size:2'],
            'sort_by.column' => ['string', Rule::in(['number'])],
            'sort_by.direction' => ['string', Rule::in(['asc', 'desc'])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
