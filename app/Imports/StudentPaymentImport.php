<?php

declare(strict_types=1);

namespace App\Imports;

use App\Enums\StudentPaymentImportStatus;
use App\Models\Student;
use App\Models\StudentPayment;
use App\Models\StudentPaymentType;
use App\Models\User;
use App\Notifications\StudentPaymentImportedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Events\ImportFailed;

class StudentPaymentImport implements ToCollection, WithChunkReading, ShouldQueue, WithStartRow, WithEvents
{
    public function __construct(
        private readonly User $importedBy,
    ) {
    }

    #[NoReturn] public function collection(Collection $collection): void
    {
        $paymentTypes = StudentPaymentType::all();
        $importedData = $collection->map(function ($row) use ($paymentTypes, $collection) {
            $studentId = Student::query()->select(['id'])
                ->where('eisu_id', $row[config('imports.student_payment.cols.eisu_id')])
                ->first()?->id;
            if (!$studentId) {
                return [];
            }
            return $paymentTypes->map(function ($paymentType) use ($studentId, $row, $collection) {
                $value = $row[config('imports.student_payment.cols.' . $paymentType->title->value)];
                return [
                    'student_id' => $studentId,
                    'student_payment_type_id' => $paymentType->id,
                    'value' => is_numeric($value) ? $value : 0.0,
                    'comment' => is_numeric($value) ? '' : $value,
                ];
            });
        })->flatten(1)->reject(fn (array $record) => empty($record));

        StudentPayment::upsert($importedData->toArray(), ['student_id', 'student_payment_type_id']);
    }

    public function chunkSize(): int
    {
        return 50;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $this->importedBy->notify(new StudentPaymentImportedNotification(
                    StudentPaymentImportStatus::Failure,
                    $event->getException()->getMessage(),
                ));
            }
        ];
    }
}
