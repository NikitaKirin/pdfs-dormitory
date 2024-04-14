<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Student;

use App\Http\Resources\V1\StudentPaymentType\StudentPaymentTypeResource;
use App\Models\StudentPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin StudentPayment */
class StudentPaymentResource extends JsonResource
{
    public static $wrap = 'student_payment';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_payment_type' => StudentPaymentTypeResource::make($this->whenLoaded('studentPaymentType')),
            'value' => $this->value,
            'comment' => $this->comment,
        ];
    }
}
