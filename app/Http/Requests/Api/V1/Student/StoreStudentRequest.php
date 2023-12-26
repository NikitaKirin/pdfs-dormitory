<?php

namespace App\Http\Requests\Api\V1\Student;

use App\Rules\DormRoom\AvailableDormRoomRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            /**
             * Only latin, space and dash symbols
             */
            'latin_name' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[A-Za-z\s-]+$/'],
            /**
             * Only cyrillic, space and dash symbols
             */
            'cyrillic_name' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[\p{Cyrillic}\s-]+$/u'],
            'is_family' => ['required', 'boolean'],
            /**
             * Telephone format: +7 (ХХХ) ХХХ-ХХ-XX
             */
            'telephone' => ['nullable', 'string', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'eisu_id' => ['nullable', 'string', 'max:255', 'unique:students'],
            'comment' => ['nullable', 'string'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'gender_id' => ['nullable', 'exists:genders,id'],
            'academic_group_id' => ['nullable', 'exists:academic_groups,id'],
            'dorm_room_id' => ['nullable', 'exists:dorm_rooms,id', new AvailableDormRoomRule()],
        ];
    }

    public function messages(): array
    {
        return [
            'telephone.regex' => __('validation.telephone_format'),
            'latin_name.regex' => __('validation.latin_name_format'),
            'cyrillic_name.regex' => __('validation.cyrillic_name_format'),
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
