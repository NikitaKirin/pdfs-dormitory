<?php

declare(strict_types=1);

use App\Enums\StudentPaymentImportStatus;

return [
  'messages' => [
      'file' => [
          'imported' => 'The file was added successfully. Wait for processing status.',
      ],
      StudentPaymentImportStatus::Success->value => 'The file was successfully imported.',
      StudentPaymentImportStatus::Failure->value => 'The file could not be imported.',
  ],
];
