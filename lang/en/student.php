<?php

declare(strict_types=1);

use App\Enums\StudentPaymentTypeEnum;

return [
    'messages' => [
        'settle' => [
            'success' => 'The student successfully settled',
            'fail' => 'An error occurred during the check-in process',
        ],
        'evict' => [
            'success' => 'The student successfully evicted',
            'fail' => 'An error occurred during the check-out process',
        ],
        'accommodated' => 'The student is already settled',
    ],
    'payments' => [
        'types' => [
            StudentPaymentTypeEnum::Educational->value => 'Educational',
            StudentPaymentTypeEnum::Communal->value => 'Communal',
            StudentPaymentTypeEnum::SecurityDeposit->value => 'Security deposit',
        ],
    ],
];
