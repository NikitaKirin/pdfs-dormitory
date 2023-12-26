<?php

namespace App\Rules\DormRoom;

use App\Models\DormRoom;
use App\Models\Student;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;

class AvailableDormRoomRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dormRoom = DormRoom::find($value);
        $student = Request::route('student');
        if ($dormRoom instanceof DormRoom && $student instanceof Student
            && $dormRoom->id !== $student->dorm_room_id
            && $dormRoom->students()->count() >= $dormRoom->number_of_seats) {
            $fail('validation.occupied_dorm_room')->translate();
        }
    }
}
