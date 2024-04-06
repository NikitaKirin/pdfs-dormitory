<?php

use App\Models\Dormitory;
use App\Models\Role;
use App\Models\SettlementHistory;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\User;

return [
    User::class => 'User',
    Role::class => 'Role',
    Dormitory::class => 'Dormitory',
    Student::class => 'Student',
    SettlementHistory::class => 'SettlementHistory',
    StudentPayment::class => 'StudentPayment',
];
