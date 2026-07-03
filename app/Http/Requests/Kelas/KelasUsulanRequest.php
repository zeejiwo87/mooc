<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasUsulanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'id_pengguna' => 'required|integer|exists:pengguna,id_pengguna',
            'rating' => 'nullable|integer|between:1,5',
            'ulasan' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kelas' => 'Kelas',
            'id_pengguna' => 'Pengguna',
            'rating' => 'Rating',
            'ulasan' => 'Ulasan',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()->messages(),
            ], 422)
        );
    }

    public function messages(): array
    {
        return [
            'required' => 'Field :attribute wajib diisi.',
            'integer' => 'Field :attribute harus berupa angka.',
            'between' => 'Field :attribute harus antara :min dan :max.',
            'string' => 'Field :attribute harus berupa teks.',
            'exists' => 'Field :attribute tidak ditemukan.',
        ];
    }
}
