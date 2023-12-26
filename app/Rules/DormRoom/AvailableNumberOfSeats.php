<?php

namespace App\Rules\DormRoom;

use App\Models\DormRoom;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Request;

class AvailableNumberOfSeats implements ValidationRule
{

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $dormRoom = Request::route('dormRoom');
        if ($dormRoom instanceof DormRoom && $dormRoom->students()->count() > $value) {
            $fail('validation.available_number_of_seats')->translate();
        }
    }
}
