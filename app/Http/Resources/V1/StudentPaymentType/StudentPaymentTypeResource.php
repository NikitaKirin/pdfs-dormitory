<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\StudentPaymentType;

use App\Models\StudentPaymentType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin StudentPaymentType */
class StudentPaymentTypeResource extends JsonResource
{
    public static $wrap = 'student_payment_type';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => __('student.payments.types.' . $this->title->value),
        ];
    }
}
