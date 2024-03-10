<?php

namespace App\Http\Requests\Api\V1\SettlementHistory;

use Illuminate\Foundation\Http\FormRequest;

class IndexSettlementHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            /**
             * Default: 15 items
             */
            'per_page' => ['nullable', 'int', 'min:1', 'max:100'],
            'dorm_room_id' => ['nullable', 'integer', 'exists:dorm_rooms,id'],
            'student_id' => ['integer', 'exists:students,id'],
            'settlement_status_id' => ['integer', 'exists:settlement_statuses,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
