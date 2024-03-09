<?php

namespace App\Events\Student;

use App\Models\DormRoom;
use App\Models\Student;
use Illuminate\Foundation\Events\Dispatchable;

class StudentEvicted
{
    use Dispatchable;

    public function __construct(
        public Student $student,
        public DormRoom $dormRoom,
    ) {}
}
