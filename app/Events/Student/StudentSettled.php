<?php

namespace App\Events\Student;

use App\Models\DormRoom;
use App\Models\Student;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;

class StudentSettled implements ShouldDispatchAfterCommit
{
    use Dispatchable;

    public function __construct(
        public Student  $student,
        public DormRoom $dormRoom
    ) {}
}
