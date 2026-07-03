<?php

namespace App\Http\Requests\App;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|string|min:8',
        ];
    }

    public function attributes(): array
    {
        return [
            'password' => 'Kata sandi',
            'password_confirmation' => 'Konfirmasi kata sandi',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi reset password gagal.')
        );
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'min' => ':attribute minimal :min karakter.',
            'confirmed' => ':attribute dan konfirmasi tidak cocok.',
            'required_with' => ':attribute wajib diisi ketika password diisi.',
        ];
    }
}
