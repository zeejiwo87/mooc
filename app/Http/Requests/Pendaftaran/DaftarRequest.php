<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DaftarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pengguna,email',
            'telepon' => 'required|string|regex:/^[0-9]{10,15}$/|unique:pengguna,telepon',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required_with:password|string',
            'terms' => 'required|accepted',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama lengkap',
            'email' => 'Email',
            'telepon' => 'Nomor telepon',
            'password' => 'Kata sandi',
            'password_confirmation' => 'Konfirmasi kata sandi',
            'terms' => 'Syarat dan ketentuan',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nama' => trim((string) $this->nama),
            'email' => strtolower((string) $this->email),
            'telepon' => preg_replace('/\D+/', '', (string) $this->telepon),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()->with('error', 'Validasi pendaftaran gagal.')
        );
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'email' => 'Format :attribute tidak valid.',
            'max' => ':attribute maksimal :max karakter.',
            'regex' => ':attribute harus berupa angka 10-15 digit.',
            'unique' => ':attribute sudah terdaftar, silakan gunakan yang lain.',
            'string' => ':attribute harus berupa teks.',
            'min' => ':attribute minimal :min karakter.',
            'confirmed' => ':attribute dan konfirmasi tidak cocok.',
            'accepted' => ':attribute harus disetujui.',
            'required_with' => ':attribute wajib diisi saat password diisi.',
        ];
    }
}
