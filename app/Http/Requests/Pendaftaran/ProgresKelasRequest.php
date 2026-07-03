<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProgresKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pendaftaran' => 'required|integer|exists:pendaftaran,id_pendaftaran',
            'id_materi' => 'required|integer|exists:materi,id_materi',
            'selesai' => 'nullable|boolean',
            'selesai_pada' => 'nullable|date',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_pendaftaran' => 'Pendaftaran',
            'id_materi' => 'Materi',
            'selesai' => 'Status Selesai',
            'selesai_pada' => 'Tanggal Selesai',
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
            'numeric' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'date' => 'Field :attribute harus berupa tanggal yang valid.',
            'in' => 'Field :attribute harus salah satu dari: :values.',
            'boolean' => 'Field :attribute harus berupa nilai benar atau salah.',
        ];
    }
}
