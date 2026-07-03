<?php

namespace App\Http\Requests\Pengguna;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateBiodataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('pengguna')->check();
    }

    public function rules(): array
    {
        $user = Auth::guard('pengguna')->user();

        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:191|unique:pengguna,email,'.$user->id_pengguna.',id_pengguna',
            'bio' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'email' => 'Email',
            'bio' => 'Bio',
            'telepon' => 'Telepon',
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
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min karakter.',
            'email' => 'Field :attribute harus berupa email yang valid.',
            'unique' => 'Field :attribute sudah digunakan.',
        ];
    }
}
