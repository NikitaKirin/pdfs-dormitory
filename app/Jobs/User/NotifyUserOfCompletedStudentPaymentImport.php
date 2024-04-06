<?php

declare(strict_types=1);

namespace App\Jobs\User;

use App\Enums\StudentPaymentImportStatus;
use App\Models\User;
use App\Notifications\StudentPaymentImportedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserOfCompletedStudentPaymentImport implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private readonly User $user)
    {
    }

    public function handle(): void
    {
        $this->user->notify(new StudentPaymentImportedNotification(StudentPaymentImportStatus::Success));
    }
}
