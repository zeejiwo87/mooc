<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KelasMentorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'peran' => 'Asisten Mentor',
        ]);
    }

    public function rules(): array
    {
        return [
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'id_mentor' => 'required|integer|exists:mentor,id_mentor',
            'peran' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kelas' => 'Kelas',
            'id_mentor' => 'Asisten Mentor',
            'peran' => 'Peran',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Field :attribute wajib diisi.',
            'string' => 'Field :attribute harus berupa teks.',
            'integer' => 'Field :attribute harus berupa angka.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'exists' => 'Field :attribute tidak ditemukan.',
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
}