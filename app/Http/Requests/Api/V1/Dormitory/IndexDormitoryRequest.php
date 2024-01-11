<?php

namespace App\Http\Requests\Api\V1\Dormitory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexDormitoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'int', 'min:1', 'max:100'],
            'with_user_info' => ['nullable', 'bool'],
            'number' => ['nullable', 'integer'],
            'address' => ['nullable', 'string'],
            /**
             * @example sort_by[column]=number&sort_by[direction]=asc
             */
            'sort_by' => ['nullable', 'array:column,direction', 'size:2'],
            'sort_by.column' => ['string', Rule::in(['number', 'address'])],
            'sort_by.direction' => ['string', Rule::in(['asc', 'desc'])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
