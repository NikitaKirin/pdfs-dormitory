<?php

declare(strict_types=1);

namespace App\Enums;

enum StudentPaymentImportStatus: string
{
    case Success = 'success';
    case Failure = 'failure';
}
