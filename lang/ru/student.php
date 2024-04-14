<?php

declare(strict_types=1);

use App\Enums\StudentPaymentTypeEnum;

return [
    'messages' => [
        'settle' => [
            'success' => 'Студент успешно поселен',
            'fail' => 'В процессе поселения произошла ошибка',
        ],
        'evict' => [
            'success' => 'Студент успешно выселен',
            'fail' => 'В процессе выселения произошла ошибка',
        ],
        'accommodated' => 'Студент уже поселен',
    ],
    'payments' => [
        'types' => [
            StudentPaymentTypeEnum::Educational->value => 'Обучение',
            StudentPaymentTypeEnum::Communal->value => 'Коммунальные платежи',
            StudentPaymentTypeEnum::SecurityDeposit->value => 'Обеспечительный платеж',
        ],
    ],
];
