<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'password' => ['required'],
            'is_admin' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
//
//    /**
//     * Prepare inputs for validation.
//     *
//     * @return void
//     */
//    protected function prepareForValidation(): void
//    {
//        $this->merge([
//            'is_admin' => $this->toBoolean($this->is_admin),
//        ]);
//    }
//
//    /**
//     * Convert to boolean
//     *
//     * @param mixed $booleable
//     * @return boolean
//     */
//    private function toBoolean(mixed $booleable): bool
//    {
//        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
//    }
}
