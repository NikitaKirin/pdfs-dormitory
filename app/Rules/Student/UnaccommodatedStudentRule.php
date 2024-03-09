<?php

namespace App\Rules\Student;

use App\Models\Student;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;

class UnaccommodatedStudentRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $student = Request::route('student');
        if ($student instanceof Student && $student->dorm_room_id !== null) {
            $fail('student.messages.accommodated')->translate();
        }
    }
}
