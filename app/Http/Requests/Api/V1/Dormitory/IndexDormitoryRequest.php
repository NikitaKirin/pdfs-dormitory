<?php

namespace App\Http\Requests\Api\V1\Dormitory;

use Illuminate\Foundation\Http\FormRequest;

class IndexDormitoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'int', 'min:1', 'max:100'],
            'with_user_info' => ['nullable', 'bool'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
