<?php

namespace App\Http\Requests\Kelas;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class KelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kategori_sub' => 'required|integer|exists:kategori_sub,id_kategori_sub',
            'id_pemilik' => 'nullable|integer|exists:mentor,id_mentor',
            'judul' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'deskripsi_singkat' => 'nullable|string|max:500',
            'deskripsi_lengkap' => 'nullable|string',
            'banner' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp|mimetypes:image/jpeg,image/png,image/webp',
            'sertifikat' => 'nullable|file|max:5120|mimes:doc,docx|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'video_intro_url' => 'nullable|url|max:255',
            'tingkat' => 'required|in:pemula,menengah,lanjutan',
            'bahasa' => 'required|in:ID,EN,AR',
            'nilai_lulus' => 'nullable|integer|between:0,100',
            'status' => 'required|in:draft,terbit,arsip',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_kategori_sub' => 'Kategori',
            'id_pemilik' => 'Pemilik',
            'judul' => 'Judul',
            'slug' => 'Slug',
            'deskripsi_singkat' => 'Deskripsi Singkat',
            'deskripsi_lengkap' => 'Deskripsi Lengkap',
            'banner' => 'Banner',
            'sertifikat' => 'Sertifikat',
            'video_intro_url' => 'Video Intro URL',
            'tingkat' => 'Tingkat',
            'bahasa' => 'Bahasa',
            'nilai_lulus' => 'Nilai Lulus',
            'status' => 'Status',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('judul', '')),
        ]);
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
            'numeric' => 'Field :attribute harus berupa angka.',
            'max' => 'Field :attribute maksimal :max karakter.',
            'min' => 'Field :attribute minimal :min.',
            'between' => 'Field :attribute harus antara :min dan :max.',
            'in' => 'Field :attribute tidak valid.',
            'exists' => 'Field :attribute tidak ditemukan.',
            'unique' => 'Field :attribute sudah digunakan.',
            'url' => 'Field :attribute harus berupa URL yang valid.',
            'banner.image' => 'Field :attribute harus berupa gambar.',
            'banner.image' => 'Field :attribute harus berupa gambar.',
            'banner.max' => 'Field :attribute maksimal :max KB.',
            'banner.mimes' => 'Field :attribute harus bertipe: jpg, jpeg, png, webp.',
            'banner.mimetypes' => 'Field :attribute harus bertipe: image/jpeg, image/png, image/webp.',
            'sertifikat.file' => 'Field :attribute harus berupa file.',
            'sertifikat.max' => 'Field :attribute maksimal :max KB.',
            'sertifikat.mimes' => 'Field :attribute harus berupa file Word dengan ekstensi .doc atau .docx.',
            'sertifikat.mimetypes' => 'Field :attribute harus bertipe application/msword atau application/vnd.openxmlformats-officedocument.wordprocessingml.document.',
        ];
    }
}
