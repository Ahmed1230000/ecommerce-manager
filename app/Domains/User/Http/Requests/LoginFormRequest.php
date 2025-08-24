<?php

namespace App\Domains\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginFormRequest extends FormRequest
{

    /**
     * Summary of authorize
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Summary of rules
     * @return array{email: string[], password: string[]}
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }
}
