<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Student\CreateStudentPaymentData;
use App\DTO\Student\UpdateStudentPaymentData;
use App\Models\StudentPayment;

class StudentPaymentService
{
    public function create(CreateStudentPaymentData $data): StudentPayment
    {
        return StudentPayment::create(
            [
                'student_id' => $data->studentId,
                'student_payment_type_id' => $data->studentPaymentTypeId,
                'value' => $data->value,
                'comment' => $data->comment,
            ],
        );
    }

    public function update(UpdateStudentPaymentData $data, StudentPayment $payment): bool
    {
        return $payment->update(
            [
                'student_id' => $data->studentId,
                'student_payment_type_id' => $data->studentPaymentTypeId,
                'value' => $data->value,
                'comment' => $data->comment,
            ],
        );
    }
}
