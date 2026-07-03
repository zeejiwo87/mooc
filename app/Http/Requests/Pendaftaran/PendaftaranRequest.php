<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PendaftaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pengguna' => 'required|integer|exists:pengguna,id_pengguna',
            'id_kelas' => 'required|integer|exists:kelas,id_kelas',
            'terdaftar_pada' => 'nullable|date',
            'status' => 'required|string|in:aktif,selesai,expired',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_pengguna' => 'Pengguna',
            'id_kelas' => 'Kelas',
            'terdaftar_pada' => 'Tanggal Pendaftaran',
            'status' => 'Status',
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
        ];
    }
}
