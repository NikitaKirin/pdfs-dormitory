<?php

declare(strict_types=1);

use App\Enums\StudentPaymentImportStatus;

return [
  'messages' => [
      'file' => [
          'imported' => 'Файл успешно добавлен. Ожидайте статус обработки.',
      ],
      StudentPaymentImportStatus::Success->value => 'Файл успешно импортирован.',
      StudentPaymentImportStatus::Failure->value => 'При импорте файла произошла ошибка',
  ],
];
