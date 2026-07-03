<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasTargetPesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'target' => 'required|string|max:500',
            'urutan' => 'required|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kelas' => 'Kelas',
            'target' => 'Target Peserta',
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
            'integer' => 'Field :attribute harus berupa angka.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',
        ];
    }
}
