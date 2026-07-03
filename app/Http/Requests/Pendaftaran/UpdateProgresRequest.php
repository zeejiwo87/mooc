<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProgresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Make optional; defaults handled in controller/service
            'waktu_belajar_detik' => 'nullable|integer|min:0',
            'posisi_video_terakhir' => 'nullable|integer|min:0',
            'selesai' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'waktu_belajar_detik' => 'Waktu Belajar (detik)',
            'posisi_video_terakhir' => 'Posisi Video Terakhir',
            'selesai' => 'Status Selesai',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Field :attribute wajib diisi.',
            'integer' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'boolean' => 'Field :attribute harus berupa nilai benar atau salah.',
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
