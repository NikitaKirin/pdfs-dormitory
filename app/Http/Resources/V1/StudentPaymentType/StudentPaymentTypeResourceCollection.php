<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\StudentPaymentType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentPaymentTypeResourceCollection extends ResourceCollection
{
    public static $wrap = 'student_payment_types';

    public function toArray(Request $request): array
    {
        return [
            'student_payment_types' => $this->collection,
        ];
    }
}
