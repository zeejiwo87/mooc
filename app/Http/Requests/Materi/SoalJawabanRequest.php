<?php

namespace App\Http\Requests\Materi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SoalJawabanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_soal' => 'required|integer|exists:soal,id_soal',
            'teks_jawaban' => 'required|string',
            'benar' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_soal' => 'Soal',
            'teks_jawaban' => 'Teks Jawaban',
            'benar' => 'Jawaban Benar',
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
            'integer' => 'Field :attribute harus berupa angka.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'boolean' => 'Field :attribute harus berupa true atau false.',
        ];
    }
}
