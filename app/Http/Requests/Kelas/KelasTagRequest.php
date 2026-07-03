<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'id_tag' => 'required|integer|exists:tag,id_tag',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kelas' => 'Kelas',
            'id_tag' => 'Tag',
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
            'exists' => 'Field :attribute tidak ditemukan.',
        ];
    }
}
