<?php

namespace App\Http\Requests\Api\V1\DormRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreDormRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'number' => ['required', 'integer', 'unique:dorm_rooms', 'min:1'],
            'number_of_seats' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
