<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Enums\StudentPaymentImportStatus;
use Illuminate\Notifications\Notification;

class StudentPaymentImportedNotification extends Notification
{
    public function __construct(
        private readonly StudentPaymentImportStatus $importStatus,
        private readonly string                     $additionalMessage = ''
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function viaConnections(): array
    {
        return [
            'database' => 'sync',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'status' => $this->importStatus->value,
            'message' => !empty($this->additionalMessage)
                ? __('imports.messages.' . $this->importStatus->value) . ' ' . $this->additionalMessage
                : __('imports.messages.' . $this->importStatus->value),
        ];
    }
}
