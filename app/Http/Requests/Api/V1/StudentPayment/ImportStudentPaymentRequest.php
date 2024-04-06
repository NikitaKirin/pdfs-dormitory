<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\StudentPayment;

use Illuminate\Foundation\Http\FormRequest;

class ImportStudentPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:xlsx', 'extensions:xlsx', 'max:2048'],
        ];
    }
}
