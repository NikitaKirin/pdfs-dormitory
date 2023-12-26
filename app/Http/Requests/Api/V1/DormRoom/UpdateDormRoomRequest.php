<?php

namespace App\Http\Requests\Api\V1\DormRoom;

use App\Rules\DormRoom\AvailableNumberOfSeats;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDormRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'dormitory_id' => ['required', 'integer', 'exists:dormitories,id'],
            'number_of_seats' => ['required', 'integer', 'min:1', new AvailableNumberOfSeats()],
            'number' => ['required', 'integer', 'min:1',
                Rule::unique('dorm_rooms')->where(
                    //todo bug in the core? Query\Builder instead of Eloquent\Builder.
                    fn(Builder $query) => $query->where('dormitory_id', $this->request->get('dormitory_id'))
                )->ignore($this->route('dormRoom'))],
            'comment' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
