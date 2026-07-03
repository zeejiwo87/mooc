<?php

namespace App\Http\Requests\Materi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KuisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_materi' => 'required|integer|exists:materi,id_materi',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'instruksi' => 'nullable|string',
            'tipe' => 'required|string|in:kuis_materi,ujian_akhir',
            'durasi_menit' => 'required|integer|min:1',
            'nilai_lulus' => 'required|integer|min:0|max:100',
            'tampilkan_jawaban_benar' => 'nullable|boolean',
            'acak_soal' => 'nullable|boolean',
            'acak_jawaban' => 'nullable|boolean',
            'aktif' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_materi' => 'Materi',
            'judul' => 'Judul Kuis',
            'deskripsi' => 'Deskripsi',
            'instruksi' => 'Instruksi',
            'tipe' => 'Tipe Kuis',
            'durasi_menit' => 'Durasi (menit)',
            'nilai_lulus' => 'Nilai Lulus',
            'tampilkan_jawaban_benar' => 'Tampilkan Jawaban Benar',
            'acak_soal' => 'Acak Soal',
            'acak_jawaban' => 'Acak Jawaban',
            'aktif' => 'Status Aktif',
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
            'min' => 'Field :attribute minimal :min.',
            'max.numeric' => 'Field :attribute maksimal :max.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'in' => 'Field :attribute harus salah satu dari: :values.',
            'boolean' => 'Field :attribute harus berupa true atau false.',
        ];
    }
}
