<?php

use App\Enums\StudentPaymentTypeEnum;

return [
    'student_payment' => [
        'cols' => [
            StudentPaymentTypeEnum::Educational->value => env('IMPORTS_PAYMENTS_EDUCATIONAL_PAYMENT_TYPE', 9),
            StudentPaymentTypeEnum::Communal->value => env('IMPORTS_PAYMENTS_COMMUNAL_PAYMENT_TYPE', 10),
            StudentPaymentTypeEnum::SecurityDeposit->value => env('IMPORTS_PAYMENTS_DEPOSIT_PAYMENT_TYPE', 11),
            'eisu_id' => env('IMPORTS_PAYMENTS_EISU_ID_PAYMENT_TYPE', 2),
        ]
    ]
];
