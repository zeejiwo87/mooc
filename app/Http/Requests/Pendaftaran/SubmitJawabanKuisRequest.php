<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubmitJawabanKuisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jawaban' => 'present|array',
            'jawaban.*.id_soal' => 'required|integer|distinct',
            'jawaban.*.id_soal_jawaban' => 'required|integer',
        ];
    }

    public function attributes(): array
    {
        return [
            'jawaban' => 'Jawaban',
            'jawaban.*.id_soal' => 'Soal',
            'jawaban.*.id_soal_jawaban' => 'Pilihan Jawaban',
        ];
    }

    public function messages(): array
    {
        return [
            'present' => 'Field :attribute wajib dikirim.',
            'required' => 'Field :attribute wajib diisi.',
            'array' => 'Field :attribute harus berupa array.',
            'integer' => 'Field :attribute harus berupa angka.',
            'distinct' => 'Field :attribute harus unik.',
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