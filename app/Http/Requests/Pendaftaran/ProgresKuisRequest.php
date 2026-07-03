<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProgresKuisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pendaftaran' => 'required|integer|exists:pendaftaran,id_pendaftaran',
            'id_kuis' => 'required|integer|exists:kuis,id_kuis',
            'nilai' => 'nullable|numeric|min:0',
            'total_soal' => 'required|integer|min:1|max:255',
            'jawaban_benar' => 'nullable|integer|min:0|lte:total_soal',
            'lulus' => 'nullable|boolean',
            'dimulai_pada' => 'nullable|date',
            'diserahkan_pada' => 'nullable|date|after_or_equal:dimulai_pada',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_pendaftaran' => 'Pendaftaran',
            'id_kuis' => 'Kuis',
            'nilai' => 'Nilai',
            'total_soal' => 'Total Soal',
            'jawaban_benar' => 'Jawaban Benar',
            'lulus' => 'Status Kelulusan',
            'diserahkan_pada' => 'Waktu Diserahkan',
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
            'date' => 'Field :attribute harus berupa tanggal yang valid.',
            'in' => 'Field :attribute harus salah satu dari: :values.',
            'boolean' => 'Field :attribute harus berupa nilai benar atau salah.',
            'lte' => 'Field :attribute tidak boleh lebih dari :value.',
            'after_or_equal' => 'Field :attribute harus setelah atau sama dengan :date.',
        ];
    }
}
