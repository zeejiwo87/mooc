<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProgresJawabanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_percobaan_kuis' => 'required|integer|exists:percobaan_kuis,id_percobaan_kuis',
            'id_soal' => 'required|integer|exists:soal,id_soal',
            'id_soal_jawaban' => 'nullable|integer|exists:soal_jawaban,id_soal_jawaban',
            'benar' => 'nullable|boolean',
            'poin_diperoleh' => 'nullable|integer|min:0|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_percobaan_kuis' => 'Percobaan Kuis',
            'id_soal' => 'Soal',
            'id_soal_jawaban' => 'Jawaban Pilihan',
            'benar' => 'Status Kebenaran',
            'poin_diperoleh' => 'Poin Diperoleh',
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
            'max' => 'Field :attribute maksimal :max.',
            'integer' => 'Field :attribute harus berupa angka.',
            'numeric' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'boolean' => 'Field :attribute harus berupa nilai benar atau salah.',
        ];
    }
}
