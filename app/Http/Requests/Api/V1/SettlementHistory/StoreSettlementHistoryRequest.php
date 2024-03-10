<?php

namespace App\Http\Requests\Api\V1\SettlementHistory;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettlementHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'student_id' => ['required', 'exists:students,id'],
            'dorm_room_id' => ['required', 'exists:dorm_rooms,id'],
            'settlement_status_id' => ['required', 'exists:settlement_statuses,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            /** @example 2024-03-10 12:28:55+00:00 */
            'created_at' => ['required', 'date_format:Y-m-d H:i:sP'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
