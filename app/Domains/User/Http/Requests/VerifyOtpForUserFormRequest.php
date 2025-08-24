<?php

namespace App\Domains\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VerifyOtpForUserFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'otp'   => ['required', 'numeric', 'digits:6', Rule::exists('otps', 'otp')->whereNull('deleted_at')]
        ];
    }
}
