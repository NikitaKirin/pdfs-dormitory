<?php

namespace App\Http\Requests\Api\V1\Student;

use App\Rules\DormRoom\AvailableDormRoomRule;
use App\Rules\Student\UnaccommodatedStudentRule;
use Illuminate\Foundation\Http\FormRequest;

class SettleStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dorm_room_id' => [
                'required',
                'exists:dorm_rooms,id',
                new UnaccommodatedStudentRule(),
                new AvailableDormRoomRule()
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
