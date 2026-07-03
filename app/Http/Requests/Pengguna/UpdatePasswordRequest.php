<?php

namespace App\Http\Requests\Pengguna;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('pengguna')->check();
    }

    public function rules(): array
    {
        return [
            'password_lama' => 'required|string',
            'password_baru' => 'required|string|min:8',
            'password_konfirmasi' => 'same:password_baru',
        ];
    }

    public function attributes(): array
    {
        return [
            'password_lama' => 'Password Lama',
            'password_baru' => 'Password Baru',
            'password_konfirmasi' => 'Konfirmasi Password Baru',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi gagal')
        );
    }

    public function messages(): array
    {
        return [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'min' => 'Field :attribute minimal :min karakter.',
            'same' => 'Field :attribute harus sama dengan :other.',
        ];
    }
}
