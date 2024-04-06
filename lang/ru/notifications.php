<?php

declare(strict_types=1);

use App\Notifications\StudentPaymentImportedNotification;

return [
  'types' => [
      StudentPaymentImportedNotification::class => 'Импорт студенческих платежей',
  ],
];
