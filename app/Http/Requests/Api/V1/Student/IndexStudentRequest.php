<?php

namespace App\Http\Requests\Api\V1\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'int', 'min:1', 'max:100'],
            'with_dormitory' => ['nullable', 'boolean'],
            'latin_name' => ['nullable', 'string'],
            'cyrillic_name' => ['nullable', 'string'],
            /**
             * @example countries[]=1&countries[]=2
             */
            'countries' => ['nullable', 'array'],
            'countries.*' => ['integer', 'exists:countries,id'],
            'gender_id' => ['nullable', 'exists:genders,id'],
            /**
             * @example sort_by[column]=latin_name&sort_by[direction]=asc
             */
            'sort_by' => ['nullable', 'array:column,direction', 'size:2'],
            'sort_by.column' => ['string', Rule::in(['latin_name', 'cyrillic_name'])],
            'sort_by.direction' => ['string', Rule::in(['asc', 'desc'])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
