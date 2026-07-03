<?php

namespace App\Http\Requests\Materi;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MateriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_bagian_kelas' => 'required|integer|exists:bagian_kelas,id_bagian_kelas',
            'judul' => 'required|string|max:255',
            'tipe' => 'required|string|in:video,kuis,text,file',

            // konten / resource
            'content' => 'nullable|string|required_if:tipe,text',
            'url_video' => 'nullable|string|max:255|required_if:tipe,video',
            'url_lampiran' => 'nullable|string|max:255|required_if:tipe,file',

            // meta
            'urutan' => 'required|integer|min:0',
            'durasi_detik' => 'nullable|integer|min:0',
            'preview' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_bagian_kelas' => 'Bagian Kelas',
            'judul' => 'Judul Materi',
            'tipe' => 'Tipe Materi',
            'content' => 'Konten',
            'url_video' => 'URL Video',
            'url_lampiran' => 'URL Lampiran',
            'urutan' => 'Urutan',
            'durasi_detik' => 'Durasi (detik)',
            'preview' => 'Preview',
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
            'required_if' => 'Field :attribute wajib diisi ketika :other bernilai :value.',
            'string' => 'Field :attribute harus berupa teks.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'integer' => 'Field :attribute harus berupa angka.',
            'min' => 'Field :attribute minimal :min.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'in' => 'Field :attribute harus salah satu dari: :values.',
            'boolean' => 'Field :attribute harus berupa true atau false.',
        ];
    }
}
