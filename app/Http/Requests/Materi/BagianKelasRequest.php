<?php

namespace App\Http\Requests\Materi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BagianKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:0',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kelas' => 'Kelas',
            'judul' => 'Judul Bagian',
            'deskripsi' => 'Deskripsi',
            'urutan' => 'Urutan',
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
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'integer' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',
        ];
    }
}
