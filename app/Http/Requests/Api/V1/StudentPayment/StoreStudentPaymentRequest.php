<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\StudentPayment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id',
                Rule::unique('student_payments', 'student_id')
                    ->where('student_payment_type_id', $this->input('student_payment_type_id')),
            ],
            'student_payment_type_id' => ['required', 'integer', 'exists:student_payment_types,id',
                Rule::unique('student_payments', 'student_payment_type_id')
                    ->where('student_id', $this->input('student_id')),
            ],
            /**
             * Format variants: X{1,8}.X{0,2}
             */
            'value' => ['required', 'regex:/^\d{1,8}\.?\d{0,2}$/'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
