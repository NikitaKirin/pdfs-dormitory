<?php

use App\Models\Dormitory;
use App\Models\Role;
use App\Models\SettlementHistory;
use App\Models\Student;
use App\Models\User;

return [
    User::class => 'Пользователь',
    Role::class => 'Роль',
    Dormitory::class => 'Общежитие',
    Student::class => 'Студент',
    SettlementHistory::class => 'История поселения',
];
