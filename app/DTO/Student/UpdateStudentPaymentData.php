<?php

declare(strict_types=1);

namespace App\DTO\Student;

final readonly class UpdateStudentPaymentData
{
    public function __construct(
        public int $studentId,
        public int $studentPaymentTypeId,
        public string $value,
        public string $comment,
    ) {
    }
}