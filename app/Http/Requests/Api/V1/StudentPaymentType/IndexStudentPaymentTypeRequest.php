<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\StudentPaymentType;

use Illuminate\Foundation\Http\FormRequest;

class IndexStudentPaymentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}