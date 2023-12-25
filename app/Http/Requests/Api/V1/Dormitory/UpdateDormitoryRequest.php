<?php

namespace App\Http\Requests\Api\V1\Dormitory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDormitoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required', 'integer',
                Rule::unique('dormitories')->ignore($this->route('dormitory'))],
            'address' => ['required', 'string', 'max:254'],
            'comment' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
