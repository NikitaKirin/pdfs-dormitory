<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentPaymentResourceCollection extends ResourceCollection
{
    public static $wrap = 'student_payments';

    public function toArray(Request $request): array
    {
        return [
            'student_payments' => $this->collection,
        ];
    }
}
