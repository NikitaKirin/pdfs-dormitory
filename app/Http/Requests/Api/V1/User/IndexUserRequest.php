<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'int', 'min:1', 'max:100']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
