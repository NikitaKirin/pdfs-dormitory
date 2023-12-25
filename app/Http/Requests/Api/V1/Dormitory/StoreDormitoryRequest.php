<?php

namespace App\Http\Requests\Api\V1\Dormitory;

use Illuminate\Foundation\Http\FormRequest;

class StoreDormitoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required', 'int', 'unique:dormitories', 'min:1'],
            'address' => ['required', 'string', 'max:254'],
            'comment' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
