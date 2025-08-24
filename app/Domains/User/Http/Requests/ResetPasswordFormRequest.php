<?php

namespace App\Domains\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordFormRequest extends FormRequest
{
    // السماح للـ request بالوصول
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'       => ['required', 'email', 'exists:users,email'],
            'token'       => ['required', 'string'],
            'newPassword' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'        => 'Email is required',
            'email.email'           => 'Email must be a valid email address',
            'email.exists'          => 'This email is not registered',
            'token.required'        => 'Token is required',
            'newPassword.required'  => 'Password is required',
            'newPassword.confirmed' => 'Password confirmation does not match',
            'newPassword.min'       => 'Password must be at least 8 characters',
        ];
    }
}
